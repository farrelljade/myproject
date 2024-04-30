<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use illuminate\View\View;

class CustomerController extends Controller
{
    // Function Showing customers. Paginated 15 per page.
    public function index(): View
    {
        // $customers = Customer::orderBy('created_at', 'desc')->paginate();
        $customers = Customer::latest()->paginate();
        return view('customers.index', [
            'customers' => $customers
        ]);
    }

    // New customer form
    public function create()
    {
        return view('customers.create');
    }
    
    // Function to handle form data and save to database
    public function store(NewCustomerRequest $request): RedirectResponse
    {
        // First check if required info is valid
        $validated = $request->validated();
        // Then create a new Customer and add to the Customer database
        Customer::create($validated);
        // Redirect back to customer_registration page
        return redirect()->back()->with('success', 'Customer created successfully!');
    }

    // Function to get customers total orders and quantity
    public function show(Customer $customer): View
    {
        $totalQuantity = $customer->orders()->sum('quantity');
        $totalOrders = $customer->orders()->count();

        return view('customers.show', [
            'totalQuantity' => $totalQuantity,
            'totalOrders' => $totalOrders,
            'customer' => $customer
        ]);
    }
}