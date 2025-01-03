<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class KaryawanMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('karyawan/kehadiran');  // Halaman login
        }

        // Jika pengguna sudah login, dan role-nya karyawan, lanjutkan request
        if (Auth::user()->usertype == 'karyawan') {
            return $next($request);
        }

        return redirect('/')->with('error', 'You do not have user access');
    }
}
