<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSnapshotFieldsToCartsTable extends Migration
{
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->string('product_name')->nullable();
            $table->decimal('unit_price_at_purchase', 20, 2)->nullable();
        });
    }

    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn(['product_name', 'unit_price_at_purchase']);
        });
    }
}