<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
    {
        Schema::table('tagihans', function (Blueprint $table) {
            // Tambahkan kolom catatan (nullable artinya boleh dikosongin)
            $table->string('catatan')->nullable()->after('jumlah_bayar');
        });
    }

    public function down()
    {
        Schema::table('tagihans', function (Blueprint $table) {
            // Untuk menghapus kolom jika di-rollback
            $table->dropColumn('catatan');
        });
    }
};
