<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OwnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('owner/dashboard');  // Halaman login
        }

        // Jika pengguna sudah login, dan role-nya owner, lanjutkan request
        if (Auth::user()->usertype == 'owner') {
            return $next($request);
        }

        return redirect('/')->with('error', 'You do not have user access');
    }
}
