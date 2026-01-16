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
        Schema::create('area_kapasitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_area')
                ->constrained('area')
                ->cascadeOnDelete();
            $table->foreignId('id_tipe_kendaraan')
                ->constrained('tipe_kendaraan')
                ->cascadeOnDelete();
            $table->integer('kapasitas');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('area_kapasitas');
    }
};
