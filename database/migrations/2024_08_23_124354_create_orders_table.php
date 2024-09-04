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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->nullable();
            $table->unsignedBigInteger('salesman_id');
            $table->unsignedBigInteger('shop_id');
            $table->integer('total_product_count');
            $table->decimal('sub_total',10,2)->default(0.00);
            $table->decimal('discount',10,2)->default(0.00);
            $table->decimal('gst',10,2)->default(0.00);
            $table->decimal('grand_total',10,2)->default(0.00);
            $table->string('payment_mode')->nullable();
            $table->tinyInteger('is_paid')->default(0);
            $table->timestamps();

            $table->foreign('salesman_id')->references('id')->on('salesmen');
            $table->foreign('shop_id')->references('id')->on('shops');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
