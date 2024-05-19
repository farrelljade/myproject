<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // Validate the input
        $user = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to authenticate/log the user in
        if (!Auth::attempt($user)) {
            throw ValidationException::withMessages([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

        // Regenerate the session ID to prevent session fixation attacks
        $request->session()->regenerate();

        // Redirect to the intended page or home
        return redirect()->route('home')->with('success', 'Successfully logged in');
    }

    public function destroy()
    {
        // Log out the user
        // Auth::guard('user')->logout();
        Auth::logout();

        // Redirect to the home page with a success message
        return redirect()->route('auth.login')->with('success', 'Successfully logged out');
    }
}
