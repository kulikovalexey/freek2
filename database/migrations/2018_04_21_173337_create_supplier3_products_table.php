<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplier3ProductsTable extends Migration
{
    /**
     * supplier3 products
     *
     * EAN
     * Product name in Estonian
     * Purchase price
     * Retail price
     */
    public function up()
    {
        Schema::create('supplier3_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku')->nullable();
            $table->string('articleCode');
            $table->string('ean')->nullable();
            $table->string('brand')->nullable();
            $table->string('name');
            $table->float('priceIncl');
            $table->integer('stockLevel')->nullable();
        });
    }


    public function down()
    {
        Schema::dropIfExists('supplier3_products');
    }
}
