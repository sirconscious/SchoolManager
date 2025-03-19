<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanViewCoursAndExames
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ( auth()->user()->role === 'admin' || auth()->user()->role === 'teacher') {
            return $next($request); // Allow the request to proceed
        }

        return redirect('/login')->with('error', 'You do not have permission to access this page.');
    }
}
