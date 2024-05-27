<?php

namespace App\Services;

use App\Models\Customer;

class CustomerService
{
    protected $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    // Get customers total quantity
    public function getTotalQuantity($id)
    {
        $customer = $this->customer->findOrFail($id);
        return $customer->orders()->sum('quantity');
    }

    // Get customers total spend
    public function getTotalSpent($id)
    {
        $customer = $this->customer->findOrFail($id);
        return $customer->orders()->sum('total_cost');
    }

    // Get total spent by a specific customer
    public function getCustomerTotalSpend($id)
    {
        $customer = $this->customer->with('orders')->findOrFail($id);
        return $customer->orders->sum('total_cost');
    }
}