<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penghuni;
use App\Models\Kamar;
use App\Models\User; // <--- TAMBAHKAN INI BIAR NGGAK NYASAR
use Illuminate\Support\Facades\Hash; // <--- TAMBAHKAN INI BUAT PASSWORD

class PenghuniController extends Controller
{
    public function index()
    {
        $penghunis = Penghuni::with('kamar')->where('status', 'Aktif')->latest()->get();
        $totalPenghuni = Penghuni::count();
        $penghuniAktif = Penghuni::where('status', 'Aktif')->count();
        $penghuniKeluar = Penghuni::where('status', 'Keluar')->count();
        $kamarKosong = \App\Models\Kamar::where('status', 'Kosong')->get();

        // TAMBAHAN: Ambil daftar siapa aja yang udah keluar
        $penghuniKeluarList = Penghuni::where('status', 'Keluar')->latest()->get();

        // Jangan lupa tambahin 'penghuniKeluarList' ke compact
        return view('admin.penghuni.index', compact('penghunis', 'totalPenghuni', 'penghuniAktif', 'penghuniKeluar', 'kamarKosong', 'penghuniKeluarList'));
    }

    // FUNGSI BARU: Untuk menyimpan data penghuni
    // FUNGSI BARU: Untuk menyimpan data penghuni
    public function store(Request $request)
    {
        // 1. Validasi Input (UBAH no_whatsapp JADI nomor_hp)
        $request->validate([
            'nama'          => 'required|string|max:255',
            'nomor_hp'      => 'required|string', // <--- UBAH DI SINI
            'pekerjaan'     => 'required|string',
            'tanggal_masuk' => 'required|date',
            'kamar_id'      => 'required|exists:kamars,id',
        ]);

        $namaBersih = strtolower(str_replace(' ', '', $request->nama));
        $usernameBaru = $namaBersih . rand(10, 99); 
        $passwordDefault = 'kos123';

        $user = User::create([
            'name'     => $request->nama,
            'username' => $usernameBaru,
            'password' => Hash::make($passwordDefault),
            'role'     => 'penghuni',
        ]);

        // 3. SIMPAN DATA PENGHUNI (UBAH no_whatsapp JADI nomor_hp)
        Penghuni::create([
            'user_id'       => $user->id,
            'nama'          => $request->nama,
            'nomor_hp'      => $request->nomor_hp, // <--- UBAH DI SINI JUGA
            'pekerjaan'     => $request->pekerjaan,
            'tanggal_masuk' => $request->tanggal_masuk,
            'kamar_id'      => $request->kamar_id,
            'status'        => 'Aktif',
        ]);

        $kamar = \App\Models\Kamar::find($request->kamar_id);
        if ($kamar) {
            $kamar->update(['status' => 'Terisi']);
        }

        return redirect()->back()->with('success_akun', 'Username: ' . $usernameBaru . ' | Password: ' . $passwordDefault);
    }

    // ==========================================
    // FUNGSI UPDATE (EDIT) DATA PENGHUNI
    // ==========================================
    public function update(Request $request, $id)
    {
        $penghuni = Penghuni::findOrFail($id);
        $kamarLama = Kamar::find($penghuni->kamar_id);
        
        $request->validate([
            'nama'      => 'required|string|max:255',
            'nomor_hp'  => 'required|string|max:15',
            'pekerjaan' => 'required|in:Mahasiswa,Karyawan,Lainnya',
            'status'    => 'required|in:Aktif,Keluar',
        ]);

        $kamar_id_baru = $request->kamar_id;

        // SKENARIO A: Anak Kos Resign / Keluar
        if ($request->status == 'Keluar') {
            if ($kamarLama) {
                $kamarLama->status = 'Kosong';
                $kamarLama->save();
            }
            $penghuni->update([
                'nama'      => $request->nama,
                'nomor_hp'  => $request->nomor_hp,
                'pekerjaan' => $request->pekerjaan,
                'kamar_id'  => null,
                'status'    => 'Keluar',
            ]);
            return redirect()->route('admin.penghuni.index')->with('success', 'Penghuni berhasil dikeluarkan, Kamar sekarang berstatus Kosong.');
        }

        // SKENARIO B: Pindah Kamar
        if ($kamar_id_baru && $kamar_id_baru != $penghuni->kamar_id) {
            if ($kamarLama) {
                $kamarLama->status = 'Kosong';
                $kamarLama->save();
            }
            $kamarBaru = Kamar::find($kamar_id_baru);
            if ($kamarBaru) {
                $kamarBaru->status = 'Terisi';
                $kamarBaru->save();
            }
        }

        $penghuni->update([
            'nama'      => $request->nama,
            'nomor_hp'  => $request->nomor_hp,
            'pekerjaan' => $request->pekerjaan,
            'kamar_id'  => $kamar_id_baru,
            'status'    => $request->status,
        ]);

        return redirect()->route('admin.penghuni.index')->with('success', 'Mantap! Data penghuni berhasil diperbarui.');
    }


    // ==========================================
    // FUNGSI HAPUS (DELETE) / KELUAR
    // ==========================================
    public function destroy($id)
    {
        $penghuni = Penghuni::findOrFail($id);

        if ($penghuni->kamar_id) {
            $kamar = \App\Models\Kamar::find($penghuni->kamar_id);
            if ($kamar) {
                $kamar->status = 'Kosong';
                $kamar->save(); // Tembus satpam database!
            }
        }

        $penghuni->update([
            'status' => 'Keluar',
            'kamar_id' => null
        ]);

        return redirect()->back()->with('success', 'Penghuni berhasil dikeluarkan! Kamar sekarang berstatus Kosong.');
    }
    // ==========================================
    // FUNGSI RESET RIWAYAT (HAPUS PERMANEN)
    // ==========================================
    public function clearKeluar()
    {
        // Hapus permanen semua data yang statusnya 'Keluar'
        Penghuni::where('status', 'Keluar')->delete();

        return redirect()->back()->with('success', 'Bim Salabim! Riwayat penghuni keluar berhasil di-reset ke 0.');
    }
}