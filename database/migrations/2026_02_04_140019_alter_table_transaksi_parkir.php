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
            $table->string('plat_nomor')->after('kode')->nullable();
            $table->foreignId('id_tipe_kendaraan')
                ->after('plat_nomor')
                ->constrained('tipe_kendaraan');
            $table->foreignId('id_data_kendaraan')
                ->nullable()
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi_parkir', function (Blueprint $table) {
            $table->dropColumn('plat_nomor');
            $table->foreignId('id_data_kendaraan')
                ->nullable(false)
                ->change();
        });
    }
};
