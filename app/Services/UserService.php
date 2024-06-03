<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    protected User $user;

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
        return $user->customers()->with('orders')->get()->sum(function ($customer) {
            return $customer->orders->sum('total_cost');
        });
    }

    public function getTotalProfit($id)
    {
        $user = $this->user->findOrFail($id);
        return $user->customers()->with('orders')->get()->sum(function ($customer) {
            return $customer->orders->sum('profit');
        });
    }

    // Get a customers total spend on a specific product
    public function getTotalProductSpent($id, $productName)
    {
        $user = $this->user->findOrFail($id);
        return $user->customers()->with(['orders' => function ($query) use ($productName) {
            $query->where('product_name', $productName);
        }])
            ->get()->sum(function ($customer) {
                return $customer->orders->sum('total_cost');
            });
    }

    // Get a customers total orders on a specific product
    public function getTotalProductOrders($id, $productName)
    {
        $user = $this->user->findOrFail($id);
        return $user->customers()->with(['orders' => function ($query) use ($productName) {
            $query->where('product_name', $productName);
        }])
            ->get()->sum(function ($customer) {
                return $customer->orders->count();
            });
    }

    // Get 10 most recent users orders
    public function getRecentOrders($id, $sortOrder = 'desc')
    {
        $user = $this->user->findOrFail($id);

        return $user->customers()
            ->join('orders', 'customers.id', '=', 'orders.customer_id')
            ->select('orders.*', 'customers.name as customer_name')
            ->orderBy('orders.created_at', $sortOrder)
            ->take(10)
            ->get();
    }

    // Get list of customers by profit and paginate by 5
    public function getCustomerProfitList($id, $sortOrder = 'total_profit_desc')
    {
        $user = $this->user->findOrFail($id);
        $customers = $user->customers()
            ->with('orders')
            ->get()
            ->map(function ($customer) {
                $customer->total_profit = $customer->orders->sum('profit');
                $customer->total_orders = $customer->orders->count();
                return $customer;
            });

        switch ($sortOrder) {
            case 'total_orders_asc':
                $customers = $customers->sortBy('total_orders');
                break;
            case 'total_orders_desc';
                $customers = $customers->sortByDesc('total_orders');
                break;
            case 'total_profit_asc':
                $customers = $customers->sortBy('total_profit');
                break;
            case 'total_profit_desc':
                $customers = $customers->sortByDesc('total_profit');
                break;
        }

        // Create a paginator
        $perPage = 10;
        $page = request()->get('page', 1);
        $offset = ($page - 1) * $perPage;

        $paginatedCustomers = new LengthAwarePaginator(
            $customers->slice($offset, $perPage),
            $customers->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return $paginatedCustomers;
    }


    // Get list of customers by Avg. profit
    public function getCustomerAvgProfitList($id)
    {
        $user = $this->user->findOrFail($id);
        $customers = $user->customers()
            ->with('orders')
            ->get()
            ->map(function ($customer) {
                $customer->avg_profit = $customer->orders->avg('ppl_profit');
                $customer->total_orders = $customer->orders->count();
                return $customer;
            });

        return $customers;
    }
}
