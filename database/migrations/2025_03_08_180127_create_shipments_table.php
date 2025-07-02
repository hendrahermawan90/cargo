<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentsTable extends Migration
{
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_number')->unique();
            $table->unsignedBigInteger('customer_id'); // relasi ke customers (pengirim)
            $table->string('sender_name');
            $table->text('sender_address');
            $table->string('receiver_name');
            $table->text('receiver_address');
            $table->decimal('weight', 8, 2);
            $table->string('status')->default('pending');
            $table->string('CompanyCode')->nullable();
            $table->boolean('IsDeleted')->default(false);
            $table->string('CreatedBy')->nullable();
            $table->timestamp('CreatedDate')->nullable();
            $table->string('LastUpdatedBy')->nullable();
            $table->timestamp('LastUpdatedDate')->nullable();

            $table->timestamps(); // created_at & updated_at
            $table->softDeletes(); // deleted_at untuk soft delete Laravel

            // Foreign key ke tabel customers
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('shipments');
    }
}
