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
        Schema::table('pengaduans', function (Blueprint $table) {
            // Tambah kolom foto setelah deskripsi (nullable karena opsional/boleh kosong)
            $table->string('foto')->nullable()->after('deskripsi');
        });
    }

    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->dropColumn('foto');
        });
    }
};
