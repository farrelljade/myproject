<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\NewCustomerRequest;

class NewCustomerController extends Controller
{
    public function index()
    {
        return view('new-customer');
    }

    // Function to handle form data and save to our database
    public function store(newCustomerRequest $request)
    {
        // First check if required info is valid
        $validated = $request->validated();
        // Then create a new Customer and add to our Customer database
        Customer:: create($validated);
        // Redirect back to customer_registration page
        return redirect()->back()->with('success', 'Customer created successfully!');
    }
}
