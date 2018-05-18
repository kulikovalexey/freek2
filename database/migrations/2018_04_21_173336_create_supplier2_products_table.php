<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplier2ProductsTable extends Migration
{


    /**
     *  supplier2 products
     *
     * ';'
     *  sku
     *  stock
     * 	currency
     * 	price
     * 	title
     * 	manufacturer
     * 	msku
     * 	ean
     *  egId
     * 	lwg1
     * 	availability
     * 	weight
     * 	width
     * 	depth
     *  height
     * 	externalStock
     */
    public function up()
    {
        Schema::create('supplier2_products', function (Blueprint $table) {
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
        Schema::dropIfExists('supplier2_products');
    }
}
