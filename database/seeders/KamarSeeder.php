<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kamar; // Panggil model Kamar

class KamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Looping bikin 20 kamar otomatis
        for ($i = 1; $i <= 20; $i++) {
            
            // Biar nomor kamarnya rapi jadi 01, 02, 09, 10, dst
            $nomor_format = str_pad($i, 2, '0', STR_PAD_LEFT);
            
            // Aturan Bisnis Yasa:
            // Jika kamar 1 sampai 10 -> Harga 650.000 (Tipe Standar)
            if ($i <= 10) {
                $tipe = 'Standar';
                $harga = 650000;
            } 
            // Jika kamar 11 sampai 20 -> Harga 850.000 (Tipe VIP)
            else {
                $tipe = 'VIP';
                $harga = 850000;
            }

            // Simpan ke database
            Kamar::create([
                'nomor_kamar' => 'Kamar ' . $nomor_format,
                'tipe_kamar'  => $tipe,
                'harga'       => $harga,
                'status'      => 'Kosong',
                'user_id'     => null, // Belum ada yang nempatin
            ]);
        }
    }
}