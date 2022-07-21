<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('operation_id')->nullable();
            $table->string('currency')->nullable();
            $table->string('order_number')->nullable();
            $table->string('delivery')->nullable();
            $table->integer('usd_delivery_fee')->nullable();
            $table->integer('zwl_delivery_fee')->nullable();
            $table->integer('usd_subtotal')->nullable();
            $table->integer('zwl_subtotal')->nullable();
            $table->integer('tax')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('usd_grandtotal')->nullable();
            $table->integer('zwl_grandtotal')->nullable();
            $table->text('notes')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
