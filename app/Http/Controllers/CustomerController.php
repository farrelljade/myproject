<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewCustomerRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    // Define table columns for the customer index view
    private function getTableColumns()
    {
        $columns = [
            ['name' => 'id', 'label' => 'Account Number'],
            ['name' => 'name', 'label' => 'Name', 'link' => 'customers.show'],
            ['name' => 'number', 'label' => 'Contact Number'],
            ['name' => 'email', 'label' => 'Email']
        ];

        return $columns;
    }

    public function index(Request $request): View | RedirectResponse
    {
        if (Auth::guest()) {
            return redirect()->route('auth.login')
                ->with('success', 'Login required!');
        }

        $query = Customer::query();

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
        $customers = $query->latest()->paginate();
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

    // Function to get customers total orders and quantity
    public function show(Customer $customer): View
    {
        $totalQuantity = $customer->orders()->sum('quantity');
        $totalOrders = $customer->orders()->count();
        $allOrders = $customer->orders()->latest()->get();

        return view('customers.show', [
            'totalQuantity' => $totalQuantity,
            'totalOrders' => $totalOrders,
            'customer' => $customer,
            'allOrders' => $allOrders
        ]);
    }
}