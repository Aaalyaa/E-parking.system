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
            $table->string('kode')->unique()->after('id');
            $table->string('metode_bayar')->nullable()->after('total_biaya');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi_parkir', function (Blueprint $table) {
            $table->dropColumn('kode');
            $table->dropColumn('metode_bayar');
        });
    }
};
