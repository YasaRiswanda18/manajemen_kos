<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; // Wajib dipanggil untuk kelola file
use App\Models\User;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('admin.profil.index', compact('user'));
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Validasi input form
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'password_lama' => 'nullable|string',
            'password_baru' => 'nullable|string|min:8|confirmed',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi foto maksimal 2MB
        ]);

        // 1. Eksekusi Ganti Password
        if ($request->filled('password_lama') || $request->filled('password_baru')) {
            if (!Hash::check($request->password_lama, $user->password)) {
                return back()->withErrors(['password_lama' => 'Password lama yang Anda masukkan salah.'])->withInput();
            }
            $user->password = Hash::make($request->password_baru);
        }

        // 2. Eksekusi Upload Foto
        if ($request->hasFile('foto_profil')) {
            // Hapus foto lama (kalau ada) biar server nggak penuh dengan sampah
            if ($user->foto_profil) {
                Storage::disk('public')->delete('profil/' . $user->foto_profil);
            }

            // Simpan foto baru ke folder storage/app/public/profil secara paksa
            $file = $request->file('foto_profil');
            $nama_file = time() . '_' . $file->getClientOriginalName();
            
            // Perhatikan bagian belakangnya, kita paksa pakai disk 'public'
            $file->storeAs('profil', $nama_file, 'public');
            
            // Masukkan nama file barunya ke database
            $user->foto_profil = $nama_file;
        }

        // 3. Simpan Nama & Username
        $user->name = $request->name;
        $user->username = $request->username;
        $user->save();

        return back()->with('success', 'Data profil dan keamanan berhasil diperbarui!');
    }
}