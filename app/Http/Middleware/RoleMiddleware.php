<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Cek apakah pengguna sudah login, dan apakah jabatannya sesuai dengan rute yang dituju
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request); // Silakan masuk, jalan terus!
        }

        // Kalau jabatannya nggak sesuai (misal penghuni nekat masuk halaman admin)
        // Tendang keluar pakai pesan error 403 (Akses Ditolak)
        abort(403, 'Waduh! Akses Ditolak. Halaman ini bukan untuk jabatan Anda.');
    }
}