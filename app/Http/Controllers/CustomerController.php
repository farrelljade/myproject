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
        // Then get the sum of customer quantity ordered
        $totalQuantity = $customer->orders()->sum('quantity');

        return view('total', [
            'totalQuantity' => $totalQuantity,
            'customer' => $customer
        ]);
    }
}