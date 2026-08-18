<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Penghuni;
use App\Models\Kamar;
use Carbon\Carbon;

class PenghuniSeeder extends Seeder
{
    public function run()
    {
        // 1. Cari data Kamar 03 dan Kamar 05 dari database
        $kamarAsep = Kamar::where('nomor_kamar', 'Kamar 03')->first();
        $kamarKangMus = Kamar::where('nomor_kamar', 'Kamar 05')->first();

        // 2. Masukkan Si Asep
        Penghuni::create([
            'kamar_id'      => $kamarAsep ? $kamarAsep->id : null,
            'nama'          => 'Asep',
            'nomor_hp'      => '081234567890',
            'pekerjaan'     => 'Mahasiswa',
            'tanggal_masuk' => Carbon::now()->subMonths(3), // Masuk 3 bulan lalu
            'status'        => 'Aktif',
        ]);

        // 3. Masukkan Kang Mus
        Penghuni::create([
            'kamar_id'      => $kamarKangMus ? $kamarKangMus->id : null,
            'nama'          => 'Kang Mus',
            'nomor_hp'      => '089876543210',
            'pekerjaan'     => 'Karyawan',
            'tanggal_masuk' => Carbon::now()->subMonths(6), // Masuk 6 bulan lalu
            'status'        => 'Aktif',
        ]);
    }
}