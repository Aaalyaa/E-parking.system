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
        Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['name', 'email', 'email_verified_at', 'remember_token']);
        $table->string('username')->unique()->after('id');
        $table->foreignId('id_role')
            ->after('password')
            ->nullable()
            ->constrained('role')
            ->nullOnDelete();
        $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->string('email')->unique()->after('name');
            $table->timestamp('email_verified_at')->nullable()->after('email');
            $table->rememberToken()->after('password');
            $table->dropForeign(['id_role']);
            $table->dropColumn(['username', 'id_role', 'deleted_at']);
        });
    }
};
