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
        Schema::create('transaksi_parkir', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_data_kendaraan')
                ->constrained('data_kendaraan');
            $table->foreignId('id_area')
                ->constrained('area');
            $table->foreignId('id_tarif')
                ->nullable()
                ->constrained('tarif');
            $table->dateTime('waktu_masuk');
            $table->dateTime('waktu_keluar')->nullable();
            $table->float('durasi_parkir')->nullable();
            $table->string('status_parkir');
            $table->float('diskon_persen')->default(0);
            $table->float('diskon_nominal')->default(0);
            $table->integer('total_biaya')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_parkir');
    }
};
