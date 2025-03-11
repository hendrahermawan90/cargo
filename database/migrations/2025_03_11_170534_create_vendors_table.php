<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Jalankan migration untuk membuat tabel vendors.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();  // Kolom id untuk vendor
            $table->string('name');  // Nama vendor
            $table->string('contact');  // Kontak vendor
            $table->string('address')->nullable();  // Alamat vendor (opsional)
            $table->string('city')->nullable();  // Kota vendor (opsional)
            $table->string('state')->nullable();  // Provinsi vendor (opsional)
            $table->string('postal_code')->nullable();  // Kode pos vendor (opsional)
            $table->string('country')->nullable();  // Negara vendor (opsional)
            $table->string('email')->nullable();  // Email vendor (opsional)
            $table->string('website')->nullable();  // Website vendor (opsional)
            $table->text('description')->nullable();  // Deskripsi vendor (opsional)
            $table->enum('status', ['active', 'inactive'])->default('active');  // Status vendor (aktif/non-aktif)
            $table->timestamps();  // Timestamps untuk created_at dan updated_at
        });
    }

    /**
     * Membatalkan migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendors');
    }
}
