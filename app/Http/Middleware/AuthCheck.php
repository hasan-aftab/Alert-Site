<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        //echo auth()->user()->email; die;
        if (auth()->check()) {
            // User is authenticated, proceed to the next request
            return $next($request);
        }

        // User is not authenticated, redirect or handle accordingly
        return redirect('/'); // Redirect to login page
    }
}
