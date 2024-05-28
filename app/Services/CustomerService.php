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

    // Get total spend of all customers
    public function getTotalSpent($id)
    {
        $customer = $this->customer->findOrFail($id);
        return $customer->orders()->sum('total_cost');
    }

    // Get total quantity by a specific customer
    public function getTotalQuantity($id)
    {
        $customer = $this->customer->findOrFail($id);
        return $customer->orders()->sum('quantity');
    }

    // Get total profit by a specific customer
    public function getTotalProfit($id)
    {
        $customer = $this->customer->findOrFail($id);
        return $customer->orders()->sum('profit');
    }

    // Get total spent by a specific customer
    public function getCustomerTotalSpend($id)
    {
        $customer = $this->customer->with('orders')->findOrFail($id);
        return $customer->orders->sum('total_cost');
    }

    // Get total orders by a specific customer
    public function getCustomerTotalOrders($id)
    {
        $customer = $this->customer->with('orders')->findOrFail($id);
        return $customer->orders->count();
    }

    // Get Avg. PPL profit by a specific customer
    public function getCustomerAvgPpl($id)
    {
        $customer = $this->customer->with('orders')->findOrFail($id);
        return $customer->orders->avg('ppl_profit');
    }
}