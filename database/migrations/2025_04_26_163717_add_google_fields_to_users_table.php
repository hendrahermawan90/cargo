<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan kolom untuk Google Auth
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('id_google')
                  ->nullable()
                  ->unique()
                  ->after('id')
                  ->comment('ID unik dari Google');
                  
            $table->string('avatar')
                  ->nullable()
                  ->after('email_verified_at')
                  ->comment('URL foto profil dari Google');
        });
    }

    /**
     * Menghapus kolom Google Auth
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['id_google', 'avatar']);
        });
    }
};