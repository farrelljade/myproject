<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): View
    {
        // Get recent orders for logged in user
        $userId = Auth::id();
        $recentOrders = $this->userService->getRecentOrders($userId);

        // Query 2 DB's in order to retrieve data
        $orders = DB::table('orders')
                    ->join('customers', 'orders.customer_id', '=', 'customers.id')
                    ->select('orders.*', 'customers.name', 'customers.email', 'customers.address', 'customers.number')
                    ->latest()
                    ->get();

        // Calculate total orders for each users customers
        $users = DB::table('users')
                    ->join('customers', 'users.id', '=', 'customers.user_id')
                    ->join('orders', 'customers.id', '=', 'orders.customer_id')
                    ->select('users.*', DB::raw('COUNT(orders.id) as orders_count'))
                    ->groupBy('users.id')
                    ->get();

        // Calculate how many of each product each users customers have ordered
        $orders = DB::table('users')
                    ->join('customers', 'users.id', '=', 'customers.user_id')
                    ->join('orders', 'customers.id', '=', 'orders.customer_id')
                    ->select('users.id', 'users.first_name', 'orders.product_name', DB::raw('COUNT(orders.product_name) as product_count'))
                    ->groupBy('users.id', 'orders.product_name')
                    ->get();

        return view('home', [
            'orders' => $orders,
            'users' => $users,
            'recentOrders' => $recentOrders
        ]);

    }
}