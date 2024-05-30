<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function ShowLoginForm()
    {

        if (Auth::guard('admin')->check()) {
            return redirect()->intended('/dynamic-form-admin'); // Redirect to the admin dashboard or any other authenticated page
        }

        return view('auth.login');
    }
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('dynamic-form-admin');
        } else {
            return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
        }

    }
    public function dashboard()
    {

    }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login.form');
    }
}
