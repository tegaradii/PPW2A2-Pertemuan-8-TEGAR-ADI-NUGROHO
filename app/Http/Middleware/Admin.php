<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === 'User') {
            return redirect()->route('dashboard')
            ->with ('noAdmin','Anda tidak diperbolehkan ke halaman admin');
            // dd('admin');
        }
        // dd('as');
        return $next($request);
    }
}
