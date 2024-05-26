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
        return $user->customers()->get();
    }

    public function getTotalOrders($id)
    {
        $user = $this->user->findOrFail($id);
        return $user->customers()->withCount('orders')->get()->sum('orders_count');
    }

    public function getTotalProductOrders($id, $productName)
    {
        $user = $this->user->findOrFail($id);
        return $user->customers()->with(['orders' => function($query) use ($productName) {
            $query->where('product_name', $productName);
        }])->get()->sum(function($customer) {
            return $customer->orders->count();
        });
    }
}