<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class FonctionnaireCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is logged in and has the 'fonctionnaire' role
        if (Auth::check() && Auth::user()->role === 'fonctionnaire') {
            return $next($request);
        }

        // Redirect unauthorized users
        return redirect('/')->with('error', 'Vous n\'avez pas accès à cette section.');
    }
}
