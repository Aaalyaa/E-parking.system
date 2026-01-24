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
        Schema::table('transaksi_parkir', function (Blueprint $table) {
            $table->dateTime('waktu_masuk')->after('id_tarif');
            $table->dateTime('waktu_keluar')->after('waktu_masuk')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi_parkir', function (Blueprint $table) {
            $table->dropColumn(['waktu_masuk', 'waktu_keluar']);
        });
    }
};
