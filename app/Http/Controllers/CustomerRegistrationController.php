<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerRegistrationController extends Controller
{
    public function index()
    {
        return view('customer_registration');
    }

    // Function to handle form data and save to our database
    public function store(Request $request)
    {
        // First ensure information is valid
        $request->validate([
            'name' => 'required|max:100',
            'address' => 'required',
            'number' => 'required',
            'email' => 'required'
        ]);
        // Now create new instance of Customer model
        $customer = new Customer();
        $customer->name = $request->input('name');
        $customer->address = $request->input('address');
        $customer->number = $request->input('number');
        $customer->email = $request->input('email');
        $customer->save();

        // Redirect back to customer_registration page
        return redirect()->back()->with('success', 'Customer created successfully!');
    }
}
