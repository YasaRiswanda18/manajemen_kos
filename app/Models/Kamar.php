<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_kamar', 'tipe_kamar', 'harga', 'status'
    ];

    // TAMBAHKAN KODE INI BOSKU 👇
    public function penghuni()
    {
        // Menyambungkan Kamar ke Penghuni (Ambil yang statusnya Aktif saja)
        return $this->hasOne(Penghuni::class, 'kamar_id')->where('status', 'Aktif');
    }
}