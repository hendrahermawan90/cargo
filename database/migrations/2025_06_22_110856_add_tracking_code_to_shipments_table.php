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
    Schema::table('shipments', function (Blueprint $table) {
        $table->string('tracking_number')->unique()->nullable()->after('id');
    });
}

public function down()
{
    Schema::table('shipments', function (Blueprint $table) {
        $table->dropColumn('tracking_number');
    });
}

};
