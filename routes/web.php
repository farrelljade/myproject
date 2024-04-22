<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/orders', [OrderController::class, 'index']);

Route::get('/customers', [CustomerController::class, 'index']);

Route::get('/customers/{id}/total', [CustomerController::class, 'totalQuantity'])->name('customers.totalQuantity');