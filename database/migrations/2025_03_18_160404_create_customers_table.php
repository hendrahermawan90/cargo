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
        Schema::create('customers', function (Blueprint $table) {
            $table->id(); // Customer ID (auto increment, primary key)
            $table->string('name'); // Kolom untuk nama pelanggan
            $table->string('email')->unique(); // Kolom untuk email pelanggan (unik)
            $table->string('phone')->nullable(); // Kolom untuk nomor telepon pelanggan (nullable)
            $table->string('address')->nullable(); // Kolom untuk alamat pelanggan (nullable)

            // Kolom tambahan sesuai permintaan
            $table->string('CompanyCode', 20)->nullable(); // Kolom CompanyCode (varchar(20))
            $table->tinyInteger('Status')->default(1); // Kolom Status (tinyint), default 1
            $table->tinyInteger('IsDeleted')->default(0); // Kolom IsDeleted (tinyint), default 0
            $table->string('CreatedBy', 32)->nullable(); // Kolom CreatedBy (varchar(32))
            $table->dateTime('CreatedDate')->nullable(); // Kolom CreatedDate (datetime)
            $table->string('LastUpdatedBy', 32)->nullable(); // Kolom LastUpdateBy (varchar(32))
            $table->dateTime('LastUpdatedDate')->nullable(); // Kolom LastUpdateDate (datetime)

            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
