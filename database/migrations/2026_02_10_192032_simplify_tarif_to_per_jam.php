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
        Schema::table('tarif', function (Blueprint $table) {
            $table->renameColumn('harga', 'tarif_per_jam');
        });

        Schema::table('tarif', function (Blueprint $table) {
            $table->dropColumn(['durasi_minimal', 'durasi_maksimal']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tarif', function (Blueprint $table) {
            $table->integer('durasi_minimal')->after('id_tipe_kendaraan');
            $table->integer('durasi_maksimal')->after('durasi_minimal');

            $table->renameColumn('tarif_per_jam', 'harga');
        });
    }
};
