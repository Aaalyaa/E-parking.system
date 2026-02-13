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
        Schema::table('log_aktivitas', function (Blueprint $table) {
            Schema::table('log_aktivitas', function (Blueprint $table) {
                $table->json('data_before')->nullable()->after('id_ref');
                $table->json('data_after')->nullable()->after('data_before');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('log_aktivitas', function (Blueprint $table) {
            $table->dropColumn('data_before');
            $table->dropColumn('data_after');
        });
    }
};
