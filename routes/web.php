<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::get('test', function () {
    \Illuminate\Support\Facades\Mail::to('farrellmikel@yahoo.com')->send(
        new \App\Mail\CallBack()
    );

    return 'Callback sent!';
});

Route::get('/', [HomeController::class, 'index'])->name('home')
    ->middleware('auth');

Route::resource('customers', CustomerController::class)
    ->middleware('auth');

Route::resource('orders', OrderController::class)
    ->middleware('auth');

// Route for autocompleting when serching for customers.
Route::get('api/customers/search', [OrderController::class, 'searchCustomers']);

Route::get('/register', [RegisterUserController::class, 'create'])->name('auth.register');
Route::post('/register', [RegisterUserController::class, 'store']);

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->name('auth.logout');

Route::resource('users', UserController::class)
    ->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/users/{id}/customers', [UserController::class, 'getCustomerList'])->name('users.customers');
    Route::get('/users/{id}/profit-list', [UserController::class, 'getUserProfit'])->name('users.profit');
});

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin/restore/{id}', [AdminController::class, 'restore'])->name('admin.restore');
});