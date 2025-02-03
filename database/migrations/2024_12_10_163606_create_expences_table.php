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
        Schema::create('expences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('expence_category_id');
            $table->unsignedBigInteger('salesmen_id');
            $table->unsignedBigInteger('trucks_id');
            $table->decimal('amount',10,2)->default(0.00);
            $table->timestamps();

            $table->foreign('expence_category_id')->references('id')->on('expence_categories')->onDelete('cascade');
            $table->foreign('salesmen_id')->references('id')->on('salesmen')->onDelete('cascade');
            $table->foreign('trucks_id')->references('id')->on('trucks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expences');
    }
};
