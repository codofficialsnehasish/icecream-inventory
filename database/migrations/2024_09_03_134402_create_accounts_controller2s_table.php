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
        Schema::create('accounts_controller2s', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('bill_type')->nullable();
            $table->string('bill_no')->nullable();
            $table->decimal('bill_amount',10,2)->default(0.00);
            $table->string('bill_pay_type')->nullable();
            $table->decimal('bill_pay_amount',10,2)->default(0.00);
            $table->decimal('extra_recived_value',10,2)->default(0.00)->nullable();
            $table->decimal('sortage_value',10,2)->default(0.00)->nullable();
            $table->decimal('free_goods_recived_value',10,2)->default(0.00)->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts_controller2s');
    }
};
