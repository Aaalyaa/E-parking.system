<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('data_kendaraan', function (Blueprint $table) {
            $table->foreign('id_member')
                  ->references('id')
                  ->on('member')
                  ->onUpdate('cascade')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('data_kendaraan', function (Blueprint $table) {
            $table->dropForeign(['id_member']);
        });
    }
};
