<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AkunController extends Controller
{
    // 1. Tampilkan Semua Akun User (Selain Admin)
    public function index()
    {
        // Ambil semua akun yang role-nya 'user' atau bukan 'admin' (Sesuaikan dengan nama kolom role kamu)
        // Jika tidak ada kolom role, gunakan: $users = User::latest()->get();
        $users = User::latest()->get(); 
        
        return view('admin.akun.index', compact('users'));
    }

    // 2. Fitur Krusial: Reset Password!
    public function resetPassword($id)
    {
        $user = User::findOrFail($id);
        
        // Reset password ke default: kos123
        $user->update([
            'password' => Hash::make('kos123')
        ]);

        return redirect()->back()->with('success', 'Berhasil! Password untuk akun ' . $user->name . ' telah direset menjadi: kos123');
    }

    // 3. Hapus Akun User
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Cegah admin menghapus akunnya sendiri (Opsional, asumsikan ID 1 adalah super admin)
        if ($user->id == 1) {
            return redirect()->back()->with('error', 'Akun Super Admin tidak boleh dihapus!');
        }

        $user->delete();

        return redirect()->back()->with('success', 'Akun user berhasil dihapus dari sistem.');
    }
}