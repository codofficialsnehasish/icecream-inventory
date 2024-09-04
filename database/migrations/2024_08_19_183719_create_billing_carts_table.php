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
        Schema::create('billing_carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('salesmen_id');
            $table->unsignedBigInteger('product_id');
            $table->string('product_billing_name');
            $table->unsignedBigInteger('variation_id')->nullable();
            $table->integer('quantity');
            $table->timestamps();

            // $table->foreign('salesmen_id')->references('id')->on('salesmen');
            // $table->foreign('product_id')->references('id')->on('salesmen');
            // $table->foreign('variation_id')->references('id')->on('variations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing_carts');
    }
};
