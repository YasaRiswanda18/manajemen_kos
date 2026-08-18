<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     * INI FUNGSI YANG TADI HILANG (Untuk nampilin form HTML)
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     * INI FUNGSI UNTUK MENYIMPAN DATA (Yang tadi kita edit)
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi Inputan
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'lowercase', 'max:255', 'unique:'.User::class],
            'nomor_kamar' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 2. Simpan Data ke Database
       $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'nomor_kamar' => $request->nomor_kamar,
            'password' => Hash::make($request->password),
            'role' => 'penghuni',
        ]);

        event(new Registered($user));

        // 1. HAPUS ATAU JADIKAN KOMENTAR BARIS INI:
        // Auth::login($user);

       return redirect()->route('login')->with('sukses', 'Akun berhasil didaftarkan! Silakan masuk menggunakan akun baru Anda.');
    }
}