<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;

Route::get('/', [HomeController::class, 'index']);
Route::resource('customers', CustomerController::class);
Route::get('/orders', [OrderController::class, 'index']);