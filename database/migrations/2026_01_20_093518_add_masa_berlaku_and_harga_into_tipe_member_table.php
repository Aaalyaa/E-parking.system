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
        Schema::table(table: 'tipe_member', callback: function (Blueprint $table) {
            $table->integer(column: 'masa_berlaku_bulanan')->after(column: 'tipe_member');
            $table->integer(column: 'harga')->after(column: 'masa_berlaku_bulanan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(table: 'tipe_member', callback: function (Blueprint $table) {
            $table->dropColumn(columns: ['masa_berlaku_bulanan', 'harga']);
        });
    }
};
