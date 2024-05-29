<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;        
    }

    public function getTotalCustomers($id)
    {
        $user = $this->user->findOrFail($id);
        return $user->customers()->count();
    }

    public function getCustomerList($id)
    {
        $user = $this->user->findOrFail($id);
        return $user->customers()->paginate(10);
    }

    public function getUserTotalOrders($id)
    {
        $user = $this->user->findOrFail($id);
        return $user->customers()->withCount('orders')->get()->sum('orders_count');
    }

    // Get users customers total spent
    public function getTotalSpent($id)
    {
        $user = $this->user->findOrFail($id);
        return $user->customers()->with('orders')->get()->sum(function($customer) {
            return $customer->orders->sum('total_cost');
        });
    }

    public function getTotalProfit($id)
    {
        $user = $this->user->findOrFail($id);
        return $user->customers()->with('orders')->get()->sum(function($customer) {
            return $customer->orders->sum('profit');
        });
    }

    // Get a customers total spend on a specific product
    public function getTotalProductSpent($id, $productName)
    {
        $user = $this->user->findOrFail($id);
        return $user->customers()->with(['orders' => function($query) use ($productName) {
            $query->where('product_name', $productName);
        }])->get()->sum(function($customer) {
            return $customer->orders->sum('total_cost');
        });
    }

    // Get a customers total orders on a specific product
    public function getTotalProductOrders($id, $productName)
    {
        $user = $this->user->findOrFail($id);
        return $user->customers()->with(['orders' => function($query) use ($productName) {
            $query->where('product_name', $productName);
        }])->get()->sum(function($customer) {
            return $customer->orders->count();
        });
    }

    // Get list of customers by profit
    public function getCustomerProfitList($id)
    {
        $user = $this->user->findOrFail($id);
        $customers = $user->customers()
            ->with('orders')
            ->get()
            ->map(function ($customer) {
                $customer->total_profit = $customer->orders->sum('profit');
                return $customer;
            })
            ->sortByDesc('total_profit');

        return $customers;
    }
}