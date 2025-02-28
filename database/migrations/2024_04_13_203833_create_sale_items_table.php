<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sale_items', function (Blueprint $table) {
            $table->string('sale_item_id', 255)->primary();
            $table->string('sale_id', 255);
            $table->string('product_id', 255)->nullable();
            $table->string('product_name', 255)->nullable();
            $table->string('product_quantity', 255)->nullable();
            $table->decimal('product_buying_price', 10, 2)->default(0.00);
            $table->decimal('product_amount', 10, 2)->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_items');
    }
};
