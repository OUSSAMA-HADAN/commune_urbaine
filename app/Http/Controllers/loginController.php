<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Redirect based on user role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'fonctionnaire') {
                return redirect()->route('fonctionnaire.dashboard');
            } elseif ($user->role === 'contable') {
                return redirect()->route('contable.dashboard');
            }

            // Fallback if no specific role matched
            return redirect('/');
        }

        return view('login');
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => ['required', 'max:255', 'email'],
            'password' => ['required']
        ]);

        // Attempt to login
        if (Auth::attempt($fields, $request->remember)) {
            $user = Auth::user(); // Get the authenticated user

            // Check the user's role and redirect accordingly
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'fonctionnaire') {
                return redirect()->route('fonctionnaire.dashboard');
            } elseif ($user->role === 'contable') {
                return redirect()->route('contable.dashboard');
            }
        } else {
            return back()->withErrors(['failed' => 'Invalid credentials']);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
