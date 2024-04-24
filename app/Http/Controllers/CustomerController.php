<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use illuminate\View\View;

class CustomerController extends Controller
{
    public function index(): View
    {
        $customers = Customer::all();
        return view('customers', compact('customers'));
    }

    public function totalQuantity($id): View
    {
        // First get the customer
        $customer = Customer::findorFail($id);
        // Get the sum of customer quantity ordered
        $totalQuantity = $customer->orders()->sum('quantity');
        // Get the total number of orders
        $totalOrders = $customer->orders()->count();

        return view('total', [
            'total_quantity' => $totalQuantity,
            'total_orders' => $totalOrders,
            'customer' => $customer
        ]);
    }
}