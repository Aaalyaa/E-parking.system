<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('member', function (Blueprint $table) {
            if (Schema::hasColumn('member', 'id_data_kendaraan')) {
                $table->dropColumn('id_data_kendaraan');
            }

            $table->foreign('id_tipe_member')
                  ->references('id')
                  ->on('tipe_member')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::table('member', function (Blueprint $table) {
            $table->dropForeign(['id_tipe_member']);

            $table->unsignedBigInteger('id_data_kendaraan')->nullable();
        });
    }
};
