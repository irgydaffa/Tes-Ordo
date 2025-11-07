<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->string('product_name')->nullable();
            $table->string('product_sku')->nullable();
            $table->text('product_description')->nullable();
            $table->decimal('price_at_purchase', 10, 2)->nullable();
            $table->string('product_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn([
                'product_name',
                'product_sku',
                'product_description',
                'price_at_purchase',
                'product_image'
            ]);
        });
    }
};
