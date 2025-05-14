<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContableCheck
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is logged in and has the 'contable' role
        if (Auth::check() && Auth::user()->role === 'contable') {
            return $next($request);
        }

        // Redirect unauthorized users
        return redirect('/')->with('error', 'You do not have access to this section.');
    }
}