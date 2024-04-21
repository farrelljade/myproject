<?php

use Illuminate\Support\Facades\Route;
use App\Models\Customer;
use App\Models\Order;

Route::get('/', function () {
    return view('home', [
        'customers' => Customer::all(),
        'orders' => Order::all()
    ]);
});

Route::get('/orders', function () {
    return view('orders', [
        'orders' => Order::all()
    ]);
});

Route::get('/customers', function () {
    return view('customers', [
        'customers' => Customer::all()
    ]);
});