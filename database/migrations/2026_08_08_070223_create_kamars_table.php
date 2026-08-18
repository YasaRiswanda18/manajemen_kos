<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kamars', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_kamar')->unique(); // Contoh: "Kamar 01"
            $table->string('tipe_kamar');            // Contoh: "Standar" atau "VIP"
            $table->integer('harga');                // 650000 atau 850000
            $table->enum('status', ['Kosong', 'Terisi'])->default('Kosong');
            
            // Relasi untuk mendata siapa yang ngisi kamar ini (bisa kosong/null kalau belum ada yang nempatin)
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); 
            
            $table->timestamps();
        });
    }
};
