<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tagihan;
use App\Models\Penghuni;
use Carbon\Carbon;

class TagihanSeeder extends Seeder
{
    public function run()
    {
        // 1. Cari data Asep dan Kang Mus
        $asep = Penghuni::where('nama', 'Asep')->first();
        $kangMus = Penghuni::where('nama', 'Kang Mus')->first();

        // 2. Asep anak rajin, dia sudah Lunas bulan ini
        if ($asep) {
            Tagihan::create([
                'penghuni_id'   => $asep->id,
                'bulan_tagihan' => 'Agustus 2026',
                'jumlah_bayar'  => 650000,
                'status'        => 'Lunas',
                'tanggal_bayar' => Carbon::now()->subDays(2), // Bayar 2 hari lalu
            ]);
        }

        // 3. Kang Mus lagi tanggal tua, jadi Belum Lunas
        if ($kangMus) {
            Tagihan::create([
                'penghuni_id'   => $kangMus->id,
                'bulan_tagihan' => 'Agustus 2026',
                'jumlah_bayar'  => 850000,
                'status'        => 'Belum Lunas',
                'tanggal_bayar' => null, // Belum ada tanggal bayar
            ]);
        }
    }
}