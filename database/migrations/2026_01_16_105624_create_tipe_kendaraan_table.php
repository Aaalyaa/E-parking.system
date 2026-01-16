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
        Schema::create('tipe_kendaraan', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'kode_tipe')->unique();
            $table->string(column: 'nama_tipe');
            $table->text(column: 'deskripsi')->nullable();
            $table->integer(column: 'ukuran_slot');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipe_kendaraan');
    }
};
