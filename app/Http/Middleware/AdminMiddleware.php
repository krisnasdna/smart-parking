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
        // Periksa apakah user sudah login dan apakah user adalah admin
        if (Auth::check() && Auth::user()->is_admin) {
            // Jika user adalah admin, lanjutkan permintaan
            return $next($request);
        }

        // Jika bukan admin, arahkan ke halaman login atau halaman error
        return redirect()->route('home')->withErrors([
            'message' => 'You do not have admin privileges.',
        ]);
    }
}
