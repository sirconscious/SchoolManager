<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and has the role of "admin"
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request); // Allow the request to proceed
        }

        // If the user is not an admin, redirect them or return an error
        return redirect('/login')->with('error', 'You do not have permission to access this page.');
    }
}
