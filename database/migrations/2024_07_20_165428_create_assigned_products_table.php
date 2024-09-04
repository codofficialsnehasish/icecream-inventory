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
        Schema::create('assigned_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('daily_sales');
            $table->longText('products')->nullable();
            $table->timestamps();

            $table->foreign('daily_sales')->references('id')->on('daily_sales')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assigned_products');
    }
};
