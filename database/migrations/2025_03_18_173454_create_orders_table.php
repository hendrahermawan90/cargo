<?php

// database/migrations/xxxx_xx_xx_create_orders_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();  // id sebagai primary key
            $table->foreignId('customer_id')->constrained()->onDelete('cascade'); // Relasi dengan tabel customers
            $table->string('tracking_number'); // Tracking number
            $table->text('origin'); // Origin (asal)
            $table->text('destination'); // Destination (tujuan)
            $table->decimal('weight', 10, 2); // Berat
            $table->decimal('price', 10, 2); // Harga
            $table->enum('order_status', ['pending', 'paid', 'shipped', 'delivered', 'cancelled'])->default('pending'); // Status pesanan dengan default "pending"
            $table->string('CompanyCode', 20)->nullable(); // Kode perusahaan
            $table->tinyInteger('Status')->default(1); // Status aktif, default 1
            $table->tinyInteger('IsDeleted')->default(0); // IsDeleted tidak terhapus, default 0
            $table->string('CreatedBy', 32); // Nama yang membuat data
            $table->dateTime('CreatedDate'); // Tanggal pembuatan
            $table->string('LastUpdatedBy', 32); // Nama yang terakhir mengubah data
            $table->dateTime('LastUpdatedDate'); // Tanggal terakhir diubah
            $table->timestamps(); // Timestamps default (created_at, updated_at)
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
