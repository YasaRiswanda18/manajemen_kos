<?php

namespace App\Http\Controllers;
use App\Models\Penghuni;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    public function index()
    {
        // 1. Ambil data tagihan (Kode lama kamu)
        $tagihans = \App\Models\Tagihan::with(['penghuni.kamar'])->latest()->get();
        $totalPemasukan = \App\Models\Tagihan::where('status', 'Lunas')->sum('jumlah_bayar');
        $totalTunggakan = \App\Models\Tagihan::where('status', 'Belum Lunas')->sum('jumlah_bayar');

        // 2. TAMBAHAN BARU: Ambil data penghuni aktif untuk dropdown Modal Satuan
        $penghuniAktifList = \App\Models\Penghuni::with('kamar')->where('status', 'Aktif')->get();

        // 3. PASTIKAN NAMA 'penghuniAktifList' MASUK KE DALAM COMPACT
        return view('admin.tagihan.index', compact('tagihans', 'totalPemasukan', 'totalTunggakan', 'penghuniAktifList'));
    }
    // FUNGSI UNTUK KONFIRMASI PEMBAYARAN TAGIHAN
    public function bayar($id)
    {
        $tagihan = Tagihan::findOrFail($id);
        
        // Update status jadi Lunas dan catat tanggal bayar hari ini
        $tagihan->update([
            'status' => 'Lunas',
            'tanggal_bayar' => \Carbon\Carbon::now()
        ]);
        
        return redirect()->back()->with('success', 'Alhamdulillah! Pembayaran berhasil dikonfirmasi. Saldo Pemasukan bertambah!');
    }
    // FUNGSI UNTUK GENERATE TAGIHAN MASSAL
    public function generate()
    {
        // 1. Siapkan senjata 2 Bahasa untuk Satpam
        $namaBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        
        $bulanIndo = $namaBulan[date('n') - 1]; // Contoh: "Agustus"
        $bulanEng  = date('F'); // Contoh: "August"
        $tahunIni  = date('Y'); // Contoh: "2026"

        // Format standar yang bakal disimpan kalau bikin tagihan massal
        $formatSimpan = $bulanIndo . ' ' . $tahunIni;

        // 2. Cari semua penghuni yang statusnya 'Aktif' dan punya kamar
        $penghuniAktif = Penghuni::with('kamar')->where('status', 'Aktif')->whereNotNull('kamar_id')->get();

        $jumlahDibuat = 0;

        foreach ($penghuniAktif as $penghuni) {
            // 🔥 SATPAM PINTAR: Cek tagihan pakai 2 bahasa (Indo/Inggris) di tahun yang sama
            $tagihanAda = Tagihan::where('penghuni_id', $penghuni->id)
                ->where(function($q) use ($bulanIndo, $bulanEng) {
                    // Cari kata "Agustus" ATAU "August"
                    $q->where('bulan_tagihan', 'like', '%' . $bulanIndo . '%')
                      ->orWhere('bulan_tagihan', 'like', '%' . $bulanEng . '%');
                })
                ->where('bulan_tagihan', 'like', '%' . $tahunIni . '%') // Pastikan tahunnya sama
                ->exists();

            // Kalau tagihan belum ada, baru dibikinin!
            if (!$tagihanAda && $penghuni->kamar) {
                Tagihan::create([
                    'penghuni_id'   => $penghuni->id,
                    'bulan_tagihan' => $formatSimpan,
                    'jumlah_bayar'  => $penghuni->kamar->harga,
                    'status'        => 'Belum Lunas',
                    'tanggal_bayar' => null,
                ]);
                $jumlahDibuat++;
            }
        }

        if ($jumlahDibuat > 0) {
            return redirect()->back()->with('success', "Wushh! Berhasil membuat $jumlahDibuat tagihan baru untuk bulan $formatSimpan.");
        } else {
            return redirect()->back()->with('success', "Aman Bos! Semua penghuni aktif sudah memiliki tagihan untuk bulan ini. Tidak ada tagihan ganda yang dibuat.");
        }
    }
    // FUNGSI BARU: Buat Tagihan Satuan
    // FUNGSI BARU: Buat Tagihan Satuan (VERSI KUMPLIT)
    public function storeManual(Request $request)
    {
        // 1. Validasi inputan form kumplit
        $request->validate([
            'penghuni_id'  => 'required|exists:penghunis,id',
            'tanggal_buat' => 'required|date',
            'jumlah_bayar' => 'required|numeric',
        ]);

        $penghuni = \App\Models\Penghuni::find($request->penghuni_id);

        // 2. Kita sulap format tanggal kalender (misal: 2026-08-09) jadi teks cantik (09 Agustus 2026)
        $tanggalEstetik = \Carbon\Carbon::parse($request->tanggal_buat)->translatedFormat('d F Y');

        // 3. Cek jangan sampai dobel tagihan di tanggal yang sama persis
        $cekTagihan = \App\Models\Tagihan::where('penghuni_id', $penghuni->id)
                                         ->where('bulan_tagihan', $tanggalEstetik)
                                         ->first();

        if ($cekTagihan) {
            return redirect()->back()->with('error', 'Tagihan untuk tanggal '.$tanggalEstetik.' sudah pernah dibuat!');
        }

        // 4. Buat tagihannya (Simpan tanggal estetik ke dalam kolom bulan_tagihan biar database aman)
        \App\Models\Tagihan::create([
            'penghuni_id'   => $penghuni->id,
            'bulan_tagihan' => $tanggalEstetik, // Masuk ke tabel dengan tulisan rapi: 09 Agustus 2026
            'jumlah_bayar'  => $request->jumlah_bayar, // Nominal fleksibel dari form, bukan kaku dari database
            'status'        => 'Belum Lunas',
        ]);

        return redirect()->back()->with('success', 'Mantap! Tagihan khusus tanggal '.$tanggalEstetik.' untuk '.$penghuni->nama.' berhasil dibuat.');
    }
    // ==========================================
    // FUNGSI UPDATE (EDIT) TAGIHAN MANUAL
    // ==========================================
    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah_bayar' => 'required|numeric',
            'catatan'      => 'nullable|string|max:255',
        ]);

        $tagihan = \App\Models\Tagihan::findOrFail($id);
        $tagihan->update([
            'jumlah_bayar' => $request->jumlah_bayar,
            'catatan'      => $request->catatan,
        ]);

        return redirect()->back()->with('success', 'Mantap! Nominal atau catatan tagihan berhasil diperbarui.');
    }

    // ==========================================
    // FUNGSI HAPUS (DELETE) TAGIHAN SALAH
    // ==========================================
    public function destroy($id)
    {
        $tagihan = \App\Models\Tagihan::findOrFail($id);
        $tagihan->delete();

        return redirect()->back()->with('success', 'Wushh! Tagihan yang salah berhasil dihapus dari sistem.');
    }
}
