<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ModifyCartProductIdAndAddForeignKey extends Migration
{
    public function up()
    {
        // Make product_id nullable using raw SQL
        DB::statement('ALTER TABLE carts MODIFY product_id BIGINT UNSIGNED NULL');

        // Add new foreign key
        Schema::table('carts', function (Blueprint $table) {
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('set null');
        });
    }

    public function down()
    {
        // Remove foreign key
        Schema::table('carts', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });

        // Make product_id not nullable using raw SQL
        DB::statement('ALTER TABLE carts MODIFY product_id BIGINT UNSIGNED NOT NULL');

        // Add back original foreign key
        Schema::table('carts', function (Blueprint $table) {
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
        });
    }
}