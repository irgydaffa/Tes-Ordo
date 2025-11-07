<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class DropCartProductForeignKey extends Migration
{
    public function up()
    {
        $foreignKeys = DB::select("
            SELECT CONSTRAINT_NAME
            FROM information_schema.TABLE_CONSTRAINTS
            WHERE CONSTRAINT_SCHEMA = DATABASE()
            AND TABLE_NAME = 'carts'
            AND CONSTRAINT_TYPE = 'FOREIGN KEY'
            AND CONSTRAINT_NAME LIKE '%product_id%'
        ");

        if (!empty($foreignKeys)) {
            Schema::table('carts', function (Blueprint $table) use ($foreignKeys) {
                foreach ($foreignKeys as $key) {
                    $table->dropForeign($key->CONSTRAINT_NAME);
                }
            });
        }
    }

    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
        });
    }
}