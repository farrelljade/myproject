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
    private function filterQuantity(Request $request)
    {
        $productName = $request->input('product_name');
        $quantity = $request->input('quantity');
        // Start query
        $query = Order::query();
        // Apply user provided filters
        if ($productName) {
            $query->where('product_name', $productName);
        }
        if ($quantity) {
            $query->where('quantity', '>=', $quantity);
        }
        return $query->latest()->paginate();
    }

    public function index(Request $request): View
    {
        $orders = $this->filterQuantity($request);
        return view('orders.index', [
            'orders' => $orders
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