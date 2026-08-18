<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Penghuni;
use App\Models\Pengaduan;

class PengaduanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $penghuni = Penghuni::where('user_id', $user->id)->first();
        
        // Ambil riwayat laporan keluhan anak kos ini
        $pengaduans = Pengaduan::where('penghuni_id', $penghuni->id)->latest()->get();

        return view('user.pengaduan.index', compact('penghuni', 'pengaduans'));
    }

    public function store(Request $request)
    {
        // Tambahkan validasi untuk file foto
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048' // Maksimal 2MB
        ]);

        $user = Auth::user();
        $penghuni = Penghuni::where('user_id', $user->id)->first();

        // Proses Upload Foto (Kalau anak kos masukin foto)
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            // Simpan foto ke folder storage/app/public/pengaduans
            $fotoPath = $request->file('foto')->store('pengaduans', 'public');
        }

        // Simpan semua data ke database
        Pengaduan::create([
            'penghuni_id' => $penghuni->id,
            'judul'       => $request->judul,
            'deskripsi'   => $request->deskripsi,
            'foto'        => $fotoPath, // <--- Masukin nama path fotonya ke DB
            'status'      => 'Menunggu'
        ]);

        return redirect()->back()->with('success', 'Mantap! Keluhan dan bukti foto berhasil dikirim ke Pak Lalan.');
    }
}