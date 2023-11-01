<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $userRole)
    {
        if (auth()->check() && auth()->user()->role == $userRole) {
            return $next($request);
        }

        abort(403, 'Hayo Kamu Mau Ngapain?');
        // return response()->json(['message' => 'You do not have permission to access this page.'], 403);
        // Jika Anda ingin menampilkan halaman khusus, Anda bisa menggunakan yang berikut:
        // return view('errors.check-permission');
    }
}
