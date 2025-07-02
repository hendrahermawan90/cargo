<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipment_id')->constrained()->onDelete('cascade');
            $table->string('payment_method');
            $table->string('status')->default('pending'); // pending, paid, failed
            $table->decimal('amount', 12, 2);
            $table->string('proof')->nullable();

            $table->timestamp('paid_at')->nullable(); // Kolom paid_at ditambahkan

            $table->string('CompanyCode')->nullable();
            $table->boolean('IsDeleted')->default(0);
            $table->string('CreatedBy')->nullable();
            $table->timestamp('CreatedDate')->nullable();
            $table->string('LastUpdatedBy')->nullable();
            $table->timestamp('LastUpdatedDate')->nullable();

            // $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
