<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewOrderRequest;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function searchCustomers(Request $request)
    {
        $search = $request->get('term');
        $customer = Customer::where('name', 'LIKE', '%'. $search. '%')->get(['id', 'name as value']);

        return response()->json($customer);
    }

    public function index(Request $request): View
    {
        $query = Order::query();

        // Explicitly select columns needed.
        $query->select(
            'orders.id as order_id',
            'orders.product_name',
            'orders.quantity',
            'orders.ppl',
            'orders.nett_cost',
            'orders.ppl_sell_at',
            'orders.vat',
            'orders.total_cost',
            'orders.profit',
            'orders.created_at as order_created_at',
            'customers.id as customer_id',
            'customers.name as customer_name',
            'customers.created_at as customer_created_at'
        );

        // Join with customers database and filter out softDeleted customers
        $query->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->whereNull('customers.deleted_at');

        // Filter by product name
        if ($productName = $request->input('product_name')) {
            $query->where('orders.product_name', $productName);
        }

        // Filter by order id
        if ($orderId = $request->input('order_id')) {
            $query->where('orders.id', $orderId);
        }

        // Filter by quantity
        if ($quantityAmount = $request->input('quantity')) {
            $query->where('orders.quantity', '>=', $quantityAmount);
        }

        // Filter by customer ID
        if ($customerId = $request->input('customer_id')) {
            $query->where('customers.id', $customerId);
        }

        // Get the latest orders after applying all filters
        $orders = $query->latest('orders.created_at')->paginate(10);

        return view('orders.index', [
            'orders' => $orders,
        ]);
    }

    public function create(Request $request): View
    {
        $customerId = $request->get('customer_id');
        $customerName = $request->get('customer_name');

        $customers = Customer::orderBy('name', 'asc')->get();
        $products = ['DERV', 'IHO', 'Kerosene', 'Gas Oil', 'AdBlue'];

        return view('orders.create', [
            'customers' => $customers,
            'products' => $products,
            'customerId' => $customerId,
            'customerName' => $customerName
        ]);
    }

    public function store(NewOrderRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        Order::create($validated);

        return redirect()->back()->with('success', 'Order created successfully');
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $products = ['DERV', 'IHO', 'Kerosene', 'Gas Oil', 'AdBlue'];

        return view('orders.edit', [
            'order' => $order,
            'products' => $products
        ]);
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->all());

        return redirect()->route('orders.show', $order->id)
                         ->with('success', 'Order successfully updated');
    }

    public function show($id): View
    {
        $order = Order::findOrFail($id);

        return view('orders.show', [
            'order' => $order
        ]);
    }
}