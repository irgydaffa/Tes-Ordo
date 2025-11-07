<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddAdditionalSnapshotFieldsToCartsTable extends Migration
{
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->string('product_sku')->nullable();
            $table->string('product_image')->nullable();
            $table->text('product_description')->nullable();
        });

        // Gunakan raw SQL untuk rename kolom
        DB::statement('ALTER TABLE carts CHANGE unit_price_at_purchase price_at_purchase DECIMAL(20,2) NULL');
    }

    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn(['product_sku', 'product_image', 'product_description']);
        });

        // Gunakan raw SQL untuk rename kolom kembali
        DB::statement('ALTER TABLE carts CHANGE price_at_purchase unit_price_at_purchase DECIMAL(20,2) NULL');
    }
}