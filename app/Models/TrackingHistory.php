<?php

public function up()
{
    Schema::create('tracking_histories', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('tracking_id');
        $table->string('status');
        $table->timestamps();

        $table->foreign('tracking_id')->references('id')->on('trackings')->onDelete('cascade');
    });
}
