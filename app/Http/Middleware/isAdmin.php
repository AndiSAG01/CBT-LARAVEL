<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->isAdmin == 1) {
                // Allow admin access
                return $next($request);
            } elseif (Auth::user()->isAdmin == 0) {
                // Redirect non-admin users
                return redirect('/pengajar');
            }
        }

        // Redirect to login if not authenticated
        return redirect('/login/guru')->with('error', 'Please log in to access this page.');
    }
    
}