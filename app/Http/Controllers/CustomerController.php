<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewCustomerRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index(): View
    {
        $customers = Customer::latest()->paginate();
        return view('customers.index', [
            'customers' => $customers
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
        // Redirect back to customer_registration page
        return redirect()->back()->with('success', 'Customer created successfully!');
    }

    public function edit($id)
    {
        // First find customer to be able to populate form fields
        $customer = Customer::findOrFail($id);

        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findorfail($id);
        $customer->update($request->all());

        return redirect()->route('customers.show', $customer->id)->with('success', 'Details successfully updated');
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