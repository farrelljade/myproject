<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewCustomerRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\CustomerService;

class CustomerController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    // Define table columns for the customer index view
    private function getTableColumns()
    {
        $columns = [
            ['name' => 'id', 'label' => 'Account Number'],
            ['name' => 'user_id', 'label' => 'Rep'],
            ['name' => 'name', 'label' => 'Name', 'link' => 'customers.show'],
            ['name' => 'number', 'label' => 'Contact Number'],
            ['name' => 'email', 'label' => 'Email']
        ];

        return $columns;
    }

    public function index(Request $request): View | RedirectResponse
    {
        // $query = Customer::query();
        $query = Customer::with('user');

        // Filter by company name
        if ($name = $request->input('customer_search')) {
            $query->where('name', $name);
        }

        // Filter by email
        if ($email = $request->input('email')) {
            $query->where('email', $email);
        }
        // Filter by number
        if ($number = $request->input('number')) {
            $query->where('number', $number);
        }

        // Filter by account number
        if ($accountNumber = $request->input('id')) {
            $query->where('id', $accountNumber);
        }

        $columns = $this->getTableColumns();
        $customers = $query->latest()->paginate(10);
        return view('customers.index', [
            'customers' => $customers,
            'columns' => $columns
        ]);
    }

    public function create()
    {
        // Retrieve all users by their first name. Customers need a user assigned to create.
        $users = User::orderBy('first_name')->get();

        return view('customers.create', [
            'users' => $users
        ]);
    }
    
    public function store(NewCustomerRequest $request): RedirectResponse
    {
        // First check if required info is valid
        $validated = $request->validated();
        // Then create a new Customer and add to the Customer database
        Customer::create($validated);

        return redirect()->back()
                         ->with('success', 'Customer created successfully!');
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);

        return view('customers.edit', [
            'customer' => $customer
        ]);
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findorfail($id);
        $customer->update($request->all());

        return redirect()->route('customers.show', $customer->id)
                         ->with('success', 'Details successfully updated');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);  
        $customer->delete();

        return redirect()->route('customers.index')
                         ->with('success', 'Customer details successfully removed');
    }

    public function show(Customer $customer): View
    {
        $totalQuantity = $this->customerService->getTotalQuantity($customer->id);
        $totalOrders = $customer->orders()->count();
        $totalSpent = $this->customerService->getTotalSpent($customer->id);
        $allOrders = $customer->orders()->latest()->paginate(5);
        $totalDerv = $this->customerService->getCustomerProductTotal($customer->id, 'DERV');
        $totalIho = $this->customerService->getCustomerProductTotal($customer->id, 'IHO');
        $totalKero = $this->customerService->getCustomerProductTotal($customer->id, 'Kerosene');
        $totalRed = $this->customerService->getCustomerProductTotal($customer->id, 'Gas Oil');
        $totalAdblue = $this->customerService->getCustomerProductTotal($customer->id, 'AdBlue');

        return view('customers.show', [
            'totalQuantity' => $totalQuantity,
            'totalOrders' => $totalOrders,
            'totalSpent' => $totalSpent,
            'customer' => $customer,
            'allOrders' => $allOrders,
            'totalDerv' => $totalDerv,
            'totalIho' => $totalIho,
            'totalKero' => $totalKero,
            'totalRed' => $totalRed,
            'totalAdblue' => $totalAdblue,
        ]);
    }
}