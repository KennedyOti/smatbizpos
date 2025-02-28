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
        Schema::create('products', function (Blueprint $table) {
            $table->string('product_id', 20)->primary();
            $table->string('product_name', 255);
            $table->text('description')->nullable();
            $table->string('SKU', 50)->nullable()->unique();
            $table->decimal('buying_price', 10, 2)->default(0.00);
            $table->decimal('marked_price', 10, 2)->default(0.00);
            $table->integer('stock_quantity')->default(0);
            $table->integer('remaining_stock')->default(0);
            $table->string('category_id', 255)->nullable();
            $table->string('sub_category_id', 255)->nullable();
            $table->string('image_URL', 255)->nullable();
            $table->integer('views')->default(0);
            $table->string('supplier', 255)->nullable();
            $table->enum('status', ['active', 'discontinued', 'out of stock'])->default('active');
            $table->string('created_by', 255)->nullable();
            $table->string('updated_by', 255)->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
