<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\UserController;

Route::get('/', [HomeController::class, 'index'])
    ->name('home')
    ->middleware('auth');

Route::resource('customers', CustomerController::class)
    ->middleware('auth');

Route::resource('orders', OrderController::class)
    ->Middleware('auth');

// Route for customer search autocomplete.
Route::get('api/customers/search', [OrderController::class, 'searchCustomers']);

// Route for registering new Users
Route::get('/register', [RegisterUserController::class, 'create'])->name('auth.register');
Route::post('/register', [RegisterUserController::class, 'store']);

// Route for showing login page, logging in auth, and logging out
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->name('auth.logout');

Route::resource('users', UserController::class)
    ->middleware('auth');