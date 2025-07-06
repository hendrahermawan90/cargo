<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDistancePriceToShipmentsTable extends Migration
{
    public function up()
    {
        Schema::table('shipments', function (Blueprint $table) {
            $table->decimal('distance_km', 8, 2)->nullable()->after('weight');
            $table->decimal('price', 15, 2)->nullable()->after('distance_km');
        });
    }

    public function down()
    {
        Schema::table('shipments', function (Blueprint $table) {
            $table->dropColumn('distance_km');
            $table->dropColumn('price');
        });
    }
}
