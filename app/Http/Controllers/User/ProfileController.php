<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Penghuni;
use App\Models\User;

class ProfileController extends Controller
{
    // 1. Nampilin Halaman Profil
    public function index()
    {
        $user = Auth::user();
        $penghuni = Penghuni::where('user_id', $user->id)->first();

        return view('user.profile.index', compact('user', 'penghuni'));
    }

    // 2. Proses Simpan Data & Password Baru
    public function update(Request $request)
    {
        $user = Auth::user();
        $penghuni = Penghuni::where('user_id', $user->id)->first();

        // Validasi input
        $request->validate([
            'nomor_hp' => 'required|string|max:20',
            // Password baru opsional, tapi kalau diisi minimal 6 karakter dan harus sama dengan konfirmasi
            'password' => 'nullable|min:6|confirmed', 
        ]);

        // A. Update Nomor HP di tabel penghuni
        if ($penghuni) {
            $penghuni->update([
                'nomor_hp' => $request->nomor_hp
            ]);
        }

        // B. Update Password di tabel users (HANYA JIKA DIISI)
        if ($request->filled('password')) {
            $userAsli = User::find($user->id);
            $userAsli->update([
                'password' => Hash::make($request->password)
            ]);
        }

        return redirect()->back()->with('success', 'Wih mantap! Profil dan Keamanan berhasil diperbarui.');
    }
}