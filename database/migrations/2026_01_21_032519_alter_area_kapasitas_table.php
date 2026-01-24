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
        Schema::table('area_kapasitas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_lokasi_area')->after('id');

            $table->foreign('id_lokasi_area')->references('id')->on('lokasi_area')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('area_kapasitas', function (Blueprint $table) {
            $table->dropForeign(['id_lokasi_area']);
            $table->dropColumn('id_lokasi_area');
        });
    }
};
