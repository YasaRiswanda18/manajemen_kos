<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penghuni extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // <--- TAMBAHKAN INI
        'nama',
        'nomor_hp',
        'pekerjaan',
        'tanggal_masuk',
        'kamar_id',
        'status',
    ];

    // Relasi ke tabel Kamar
    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    // Relasi ke tabel User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}