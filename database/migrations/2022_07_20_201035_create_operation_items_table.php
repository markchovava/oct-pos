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
        Schema::create('operation_items', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->nullable();
            $table->bigInteger('operation_id')->nullable();
            $table->integer('usd_unit_price')->nullable();
            $table->integer('zwl_unit_price')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('usd_product_total')->nullable();
            $table->integer('zwl_product_total')->nullable();
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
        Schema::dropIfExists('operation_items');
    }
};
