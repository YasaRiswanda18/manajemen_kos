<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tagihan;
use App\Models\Penghuni; 

class TagihanController extends Controller
{
    // 1. Tampilkan Semua Data Tagihan (Dengan Filter & Search)
    public function index(Request $request)
    {
        $query = Tagihan::with(['penghuni.kamar'])->latest();

        // B. Filter Pencarian Nama
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('penghuni', function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%');
            });
        }

        // C. Filter Bulan (Mesin Jaring 2 Bahasa)
        if ($request->filled('bulan') && $request->bulan != 'Semua Bulan') {
            $bulanIndo = $request->bulan; // Contoh: "Agustus"

            // Kamus terjemahan Lokal ke Bule
            $kamusBulan = [
                'Januari' => 'January', 'Februari' => 'February', 'Maret' => 'March',
                'April' => 'April', 'Mei' => 'May', 'Juni' => 'June',
                'Juli' => 'July', 'Agustus' => 'August', 'September' => 'September',
                'Oktober' => 'October', 'November' => 'November', 'Desember' => 'December'
            ];

            $bulanInggris = $kamusBulan[$bulanIndo] ?? $bulanIndo;

            // Cari pakai 2 bahasa sekaligus! (Agustus ATAU August)
            $query->where(function($q) use ($bulanIndo, $bulanInggris) {
                $q->where('bulan_tagihan', 'like', '%' . $bulanIndo . '%')
                  ->orWhere('bulan_tagihan', 'like', '%' . $bulanInggris . '%');
            });
        }

        $tagihans = $query->get();
        
        $totalPemasukan = $tagihans->where('status', 'Lunas')->sum('jumlah_bayar');
        $totalTunggakan = $tagihans->whereIn('status', ['Belum Lunas', 'Menunggu Konfirmasi'])->sum('jumlah_bayar');
        
        $penghuniAktifList = Penghuni::with('kamar')->get(); 
        
        return view('admin.tagihan.index', compact('tagihans', 'totalPemasukan', 'totalTunggakan', 'penghuniAktifList'));
    }

    // 2. Fungsi Backup / Cetak PDF
    public function cetakLaporan(Request $request)
    {
        $query = Tagihan::with(['penghuni.kamar'])->latest();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('penghuni', function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%');
            });
        }

        // Samain jaring bahasanya buat di PDF juga
        if ($request->filled('bulan') && $request->bulan != 'Semua Bulan') {
            $bulanIndo = $request->bulan;
            $kamusBulan = [
                'Januari' => 'January', 'Februari' => 'February', 'Maret' => 'March',
                'April' => 'April', 'Mei' => 'May', 'Juni' => 'June',
                'Juli' => 'July', 'Agustus' => 'August', 'September' => 'September',
                'Oktober' => 'October', 'November' => 'November', 'Desember' => 'December'
            ];
            $bulanInggris = $kamusBulan[$bulanIndo] ?? $bulanIndo;

            $query->where(function($q) use ($bulanIndo, $bulanInggris) {
                $q->where('bulan_tagihan', 'like', '%' . $bulanIndo . '%')
                  ->orWhere('bulan_tagihan', 'like', '%' . $bulanInggris . '%');
            });
        }

        $tagihans = $query->get();
        $totalPemasukan = $tagihans->where('status', 'Lunas')->sum('jumlah_bayar');

        return view('admin.tagihan.cetak', compact('tagihans', 'totalPemasukan'));
    }

    // 3. Fungsi Pak Lalan Konfirmasi Pembayaran
    public function konfirmasi($id)
    {
        $tagihan = Tagihan::findOrFail($id);
        $tagihan->update(['status' => 'Lunas']);
        return redirect()->back()->with('success', 'Sah! Pembayaran berhasil dikonfirmasi. Status tagihan otomatis menjadi Lunas.');
    }
    
    // 4. Fungsi Pak Lalan Tolak Pembayaran
    public function tolak(Request $request, $id)
    {
        $request->validate(['alasan_tolak' => 'required|string|max:255']);
        $tagihan = Tagihan::findOrFail($id);
        $tagihan->update([
            'status'       => 'Ditolak',
            'alasan_tolak' => $request->alasan_tolak,
            'bukti_bayar'  => null
        ]);
        return redirect()->back()->with('success', 'Pembayaran berhasil ditolak. Anak kos akan menerima notifikasi alasannya.');
    }

    // 5. Fungsi Sapu Jagat
    public function bersihkanArsip(Request $request)
    {
        $query = Tagihan::where('status', 'Lunas');

        // Samain juga buat fitur bersihkan arsipnya
        if ($request->filled('bulan') && $request->bulan != 'Semua Bulan') {
            $bulanIndo = $request->bulan;
            $kamusBulan = [
                'Januari' => 'January', 'Februari' => 'February', 'Maret' => 'March',
                'April' => 'April', 'Mei' => 'May', 'Juni' => 'June',
                'Juli' => 'July', 'Agustus' => 'August', 'September' => 'September',
                'Oktober' => 'October', 'November' => 'November', 'Desember' => 'December'
            ];
            $bulanInggris = $kamusBulan[$bulanIndo] ?? $bulanIndo;

            $query->where(function($q) use ($bulanIndo, $bulanInggris) {
                $q->where('bulan_tagihan', 'like', '%' . $bulanIndo . '%')
                  ->orWhere('bulan_tagihan', 'like', '%' . $bulanInggris . '%');
            });
        }

        $jumlahDihapus = $query->count();
        if ($jumlahDihapus == 0) {
            return redirect()->back()->with('error', 'Tidak ada data berstatus LUNAS pada filter bulan ini yang bisa dibersihkan.');
        }
        $query->delete();
        return redirect()->back()->with('success', "Beres Bos! $jumlahDihapus arsip tagihan Lunas berhasil dibersihkan permanen dari sistem.");
    }
}