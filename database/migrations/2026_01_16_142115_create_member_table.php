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
        Schema::create('member', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_data_kendaraan')
                ->constraited('data_kendaraan');
            $table->foreignId('id_tipe_member')
                ->constraited('tipe_member');
            $table->date('tanggal_bergabung');
            $table->date('tanggal_kadaluarsa');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member');
    }
};
