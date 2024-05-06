<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(): View
    {
        // Query 2 DB's in order to retrieve data
        $orders = DB::table('orders')
                    ->join('customers', 'orders.customer_id', '=', 'customers.id')
                    ->select('orders.*', 'customers.name', 'customers.email', 'customers.address', 'customers.number')
                    ->latest()->get();

        // $users = DB::table('customers')
        //             ->join('orders', 'customers.id', '=', 'orders.customer_id')
        //             ->select('customers.*', 'orders.total_cost')
        //             ->latest()->get();

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


        // $users = DB::table('customers')
        //             ->leftJoin('orders', 'customers.id', '=', 'orders.customer_id')
        //             ->latest()->get();

        // $users = DB::table('orders')
        //             ->rightJoin('customers', 'orders.customer_id', '=', 'customers.id')
        //             ->latest()->get();

        return view('home', [
            'orders' => $orders,
            'users' => $users
        ]);
    }
}