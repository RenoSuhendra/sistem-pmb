<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login DAN memiliki peran 'admin'
        if (Auth::check() && Auth::user()->role == 'admin') {
            // Jika ya, lanjutkan ke request berikutnya
            return $next($request);
        }

        // Jika tidak, redirect ke halaman home mahasiswa
        return redirect('/home');
    }
}
