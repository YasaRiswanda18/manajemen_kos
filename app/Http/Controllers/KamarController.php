<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;

class KamarController extends Controller
{
    public function index()
    {
        // TAMBAHKAN with('penghuni') BIAR NAMANYA IKUT KEBAWA DARI DATABASE
        $kamars = Kamar::with('penghuni')->get();
        
        // (Biarkan kode hitung-hitungan total kamar, kosong, terisi di bawahnya tetap aman)
        $totalKamar = Kamar::count();
        $kamarTerisi = Kamar::where('status', 'Terisi')->count();
        $kamarKosong = Kamar::where('status', 'Kosong')->count();

        return view('admin.kamar.index', compact('kamars', 'totalKamar', 'kamarTerisi', 'kamarKosong'));
    }

    // FUNGSI BARU: Untuk menyimpan data kamar
    public function store(Request $request)
    {
        // 1. Validasi data (Biar Pak Lalan nggak masukin data kosong/dobel)
        $request->validate([
            'nomor_kamar' => 'required|string|unique:kamars,nomor_kamar',
            'tipe_kamar'  => 'required|in:Standar,VIP',
            'harga'       => 'required|numeric|min:0',
        ], [
            'nomor_kamar.required' => 'Nomor kamar wajib diisi!',
            'nomor_kamar.unique'   => 'Nomor kamar ini sudah ada di sistem!',
            'harga.required'       => 'Harga sewa wajib diisi!',
        ]);

        // 2. Simpan ke database
        Kamar::create([
            'nomor_kamar' => $request->nomor_kamar,
            'tipe_kamar'  => $request->tipe_kamar,
            'harga'       => $request->harga,
            'status'      => 'Kosong', // Default otomatis kosong
        ]);

        // 3. Kembalikan ke halaman tabel dengan pesan sukses
        return redirect()->route('admin.kamar.index')->with('success', 'Mantap! Kamar baru berhasil ditambahkan.');
    }
    // FUNGSI BARU: Untuk memproses update data kamar
    public function update(Request $request, $id)
    {
        // 1. Validasi data
        // Catatan penting: unique:kamars,nomor_kamar,$id memastikan sistem tidak error "nomor sudah dipakai" jika kita mengedit kamar yang sama.
        $request->validate([
            'nomor_kamar' => 'required|string|unique:kamars,nomor_kamar,' . $id,
            'tipe_kamar'  => 'required|in:Standar,VIP',
            'harga'       => 'required|numeric|min:0',
            'status'      => 'required|in:Kosong,Terisi',
        ], [
            'nomor_kamar.required' => 'Nomor kamar wajib diisi!',
            'nomor_kamar.unique'   => 'Nomor kamar ini sudah ada di sistem!',
            'harga.required'       => 'Harga sewa wajib diisi!',
        ]);

        // 2. Cari kamar berdasarkan ID yang mau di-edit
        $kamar = Kamar::findOrFail($id);

        // 3. Update datanya di database
        $kamar->update([
            'nomor_kamar' => $request->nomor_kamar,
            'tipe_kamar'  => $request->tipe_kamar,
            'harga'       => $request->harga,
            'status'      => $request->status,
        ]);

        // 4. Kembalikan ke halaman tabel dengan pesan sukses
        return redirect()->route('admin.kamar.index')->with('success', 'Wushh! Data kamar berhasil diperbarui.');
    }
    // FUNGSI BARU: Untuk menghapus data kamar
    public function destroy($id)
    {
        // 1. Cari kamar yang mau dihapus
        $kamar = Kamar::findOrFail($id);

        // 2. Hancurkan dari database
        $kamar->delete();

        // 3. Kembalikan ke halaman tabel dengan pesan sukses
        return redirect()->route('admin.kamar.index')->with('success', 'Data kamar berhasil dihapus selamanya dari sistem!');
    }
}