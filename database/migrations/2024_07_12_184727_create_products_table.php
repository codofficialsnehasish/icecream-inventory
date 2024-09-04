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
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->unsignedBigInteger('category');
            $table->unsignedBigInteger('sub_category')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('discount_rate', 5, 2)->nullable();
            $table->decimal('discount_price', 10, 2);
            $table->decimal('gst_rate', 5, 2)->nullable();
            $table->decimal('gst_amount', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->string('product_main_image')->nullable();
            $table->string('stock')->default(0)->nullable();
            $table->string('box_quantity')->default(0)->nullable();
            $table->boolean('visibility')->default(0);
            $table->timestamps();

            $table->foreign('category')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('sub_category')->references('id')->on('categories')->onDelete('cascade');
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
