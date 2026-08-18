<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Models\Kamar;
use App\Models\Penghuni;
use App\Models\Tagihan;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil Data Kamar
        $totalKamar = Kamar::count();
        $kamarKosong = Kamar::where('status', 'Kosong')->count();
        $kamarTerisi = Kamar::where('status', 'Terisi')->count();

        // 2. Ambil Data Penghuni (Tadi ini nggak sengaja kehapus wkwk)
        $penghuniAktif = Penghuni::where('status', 'Aktif')->count();
        // Ambil 4 penghuni terbaru buat mejeng di tabel dashboard
        $penghunisTerbaru = Penghuni::with('kamar')->latest()->take(4)->get();

        // 3. Ambil Data Keuangan (Rumus Sapu Jagat)
        $namaBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $bulanIni = $namaBulan[date('n') - 1] . ' ' . date('Y'); // Target: "Agustus 2026"
        
        // Bikin variasi format buat nangkep data yang "Bule" atau bentuk "Tanggal"
        $bulanBule = date('F Y'); // Target: "August 2026"
        $bulanAngka = date('Y-m'); // Target: "2026-08"
        
        // Hitung semua tagihan lunas yang mengandung unsur bulan ini
        $pemasukan = Tagihan::where('status', 'Lunas')
            ->where(function($query) use ($bulanIni, $bulanBule, $bulanAngka) {
                $query->where('bulan_tagihan', 'like', '%' . $bulanIni . '%')       // Nangkap "Agustus 2026"
                      ->orWhere('bulan_tagihan', 'like', '%' . $bulanBule . '%')    // Nangkap "August 2026"
                      ->orWhere('bulan_tagihan', 'like', '%' . $bulanAngka . '%');  // Nangkap "2026-08"
            })->sum('jumlah_bayar');

            $pengaduanTerbaru = Pengaduan::where('status', '!=', 'Selesai') // Jangan tampilkan yang udah beres
                                     ->latest()
                                     ->take(3)
                                     ->get();

        // 4. Kirim semua datanya ke tampilan
        return view('admin.dashboard', compact(
            'totalKamar', 'kamarKosong', 'kamarTerisi', 
            'penghuniAktif', 'pemasukan', 'bulanIni', 'penghunisTerbaru', 'pengaduanTerbaru'
        ));
    }
}