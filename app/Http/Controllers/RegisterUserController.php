<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Validate the input
        $credentials = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        // Create User
        $user = User::create($credentials);

        // Log user in
        Auth::login($user);

        // Regenerate the session ID to prevent session fixation attacks
        $request->session()->regenerate();

        return redirect()->route('home')->with('success', 'Successfully logged in');
    }

}
