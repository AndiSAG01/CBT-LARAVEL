<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RestrictIpMiddleware
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
        // Cetak alamat IP yang diterima Laravel
        // dd($request->ip());
    
        $allowed_ips = ['192.168.42.162'];
    
        if (!in_array($request->ip(), $allowed_ips)) {
            return response()->json(['message' => 'Akses ditolak'], 403);
        }
    
        return $next($request);
    }
    
}
