<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;
use App\Services\UserService;
use App\Models\User;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    protected $userService, $customerService;

    public function __construct(UserService $userService, CustomerService $customerService)
    {
        $this->userService = $userService;
        $this->customerService = $customerService;
    }

    public function index(): View
    {
        $users = User::all();

        return view('users.index', [
            'users' => $users
        ]);
    }

    public function show($id): View
    {
        $user = User::findOrFail($id);
        $totalCustomers = $this->userService->getTotalCustomers($id);
        $totalOrders = $this->userService->getUserTotalOrders($id);
        $totalDerv = $this->userService->getTotalProductOrders($id, 'DERV');
        $totalIho = $this->userService->getTotalProductOrders($id, 'IHO');
        $totalKero = $this->userService->getTotalProductOrders($id, 'Kerosene');
        $totalGas = $this->userService->getTotalProductOrders($id, 'Gas Oil');
        $totalAdblue = $this->userService->getTotalProductOrders($id, 'AdBlue');
        $totalSpent = $this->customerService->getTotalSpent($id);

        return view('users.show', [
            'user' => $user,
            'totalCustomers' => $totalCustomers,
            'totalOrders' => $totalOrders,
            'totalDerv' => $totalDerv,
            'totalIho' => $totalIho,
            'totalKero' => $totalKero,
            'totalGas' => $totalGas,
            'totalAdblue' => $totalAdblue,
            'totalSpent' => $totalSpent,
        ]);
    }

    public function getCustomerList($id): View
    {
        $customerList = $this->userService->getCustomerList($id);

        foreach ($customerList as $customer) {
            $customerTotals[$customer->id] = $this->customerService->getCustomerTotalSpend($customer->id);
        }

        return view('users.customers', [
            'user' => User::findOrFail($id),
            'customerList' => $customerList,
            'customerTotals' => $customerTotals
        ]);
    }
}
