<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;

Route::get('/', [HomeController::class, 'index']);
Route::resource('customers', CustomerController::class);
Route::resource('orders', OrderController::class);

// Route for customer search autocomplete.
Route::get('api/customers/search', [OrderController::class, 'searchCustomers']);
