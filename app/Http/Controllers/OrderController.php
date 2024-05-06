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

    // Filter by product name
    if ($productName = $request->input('product_name')) {
        $query->where('product_name', $productName);
    }

    // Filter by order id
    if ($orderId = $request->input('order_id')) {
        $query->where('id', $orderId);
    }

    // Filter by quantity
    if ($quantityAmount = $request->input('quantity')) {
        $query->where('quantity', '>=', $quantityAmount);
    }

    // Filter by customer
    if ($customerId = $request->input('customer_id')) {
        $query->where('customer_id', $customerId);
    }

    // Get the latest orders after applying all filters
    $orders = $query->latest()->paginate(10);

    return view('orders.index', [
        'orders' => $orders,
    ]);
}

    public function create(): View
    {
        $customers = Customer::orderBy('name', 'asc')->get();
        $products = ['DERV', 'IHO', 'Kerosene', 'Gas Oil', 'AdBlue'];
        return view('orders.create', [
            'customers' => $customers,
            'products' => $products
        ]);
    }

    public function store(NewOrderRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        Order::create($validated);
        return redirect()->back()->with('success', 'Order created successfully');
    }
}