<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCheck
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is logged in and has the 'admin' role
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Redirect unauthorized users (e.g., to home page)
        return redirect('/')->with('error', 'You do not have access to this section.');
    }
}
