<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Models\User;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
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
        $totalOrders = $this->userService->getTotalOrders($id);
        $totalDerv = $this->userService->getTotalProductOrders($id, 'DERV');
        $totalIho = $this->userService->getTotalProductOrders($id, 'IHO');
        $totalKero = $this->userService->getTotalProductOrders($id, 'Kerosene');
        $totalGas = $this->userService->getTotalProductOrders($id, 'Gas Oil');
        $totalAdblue = $this->userService->getTotalProductOrders($id, 'AdBlue');

        return view('users.show', [
            'user' => $user,
            'totalCustomers' => $totalCustomers,
            'totalOrders' => $totalOrders,
            'totalDerv' => $totalDerv,
            'totalIho' => $totalIho,
            'totalKero' => $totalKero,
            'totalGas' => $totalGas,
            'totalAdblue' => $totalAdblue,
        ]);
    }

    public function getCustomerList($id): View
    {
        $customerList = $this->userService->getCustomerList($id);

        return view('users.customers', [
            'user' => User::findOrFail($id),
            'customerList' => $customerList
        ]);
    }
}
