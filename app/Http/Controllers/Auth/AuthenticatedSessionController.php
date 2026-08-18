<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view. (Menampilkan halaman login)
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request. (Proses Login & Polisi Lalu Lintas)
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // ==========================================
        // LOGIC PENGATUR JALAN (ROLE BERDASARKAN AKUN)
        // ==========================================
        $user = $request->user();

        // Kalau yang login Admin
        if ($user->role === 'admin') {
            return redirect()->intended(route('admin.dashboard'));
        } 
        
        // Kalau yang login Anak Kos (Penghuni)
        elseif ($user->role === 'penghuni') {
            return redirect()->intended(route('user.dashboard'));
        }

        // Default kalau rolenya nggak jelas
        return redirect()->intended('/dashboard');
    }

    /**
     * Destroy an authenticated session. (Proses Logout)
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Setelah logout, lempar kembali ke halaman depan / login
        return redirect('/');
    }
}