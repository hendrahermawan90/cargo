<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackingsTable extends Migration
{
    public function up()
    {
        Schema::create('trackings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipment_id')->constrained()->onDelete('cascade');
            $table->string('status'); // Status langkah ini (ex: "Transit di Bandung", "Dikirim oleh Kurir", dsb)
            $table->string('location')->nullable(); // Lokasi peristiwa
            $table->text('notes')->nullable(); // Catatan opsional
            $table->string('proof_image')->nullable(); // Bukti pengiriman (foto)
            
            // Metadata umum
            $table->string('CompanyCode')->default('DEFAULT');
            $table->boolean('IsDeleted')->default(0);
            $table->string('CreatedBy')->nullable();
            $table->timestamp('CreatedDate')->nullable();
            $table->string('LastUpdatedBy')->nullable();
            $table->timestamp('LastUpdatedDate')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trackings');
    }
}
