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
        Schema::create('bill_settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('gstin')->nullable();
            $table->string('fssai_license')->nullable();
            $table->tinyInteger('is_tax_show')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_settings');
    }
};
