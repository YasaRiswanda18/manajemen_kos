<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $guarded = []; // Izinkan semua kolom diisi massal

    // Relasi balik ke tabel Penghuni
    public function penghuni()
    {
        return $this->belongsTo(Penghuni::class);
    }
}