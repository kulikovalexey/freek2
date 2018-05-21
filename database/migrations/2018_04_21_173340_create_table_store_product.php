<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStoreProduct extends Migration
{
    public function up()
    {
        Schema::create('store_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('_id');
            $table->string('name');
            $table->string('createdAt');
            $table->string('updatedAt');
            $table->string('visibility')->nullable();
            $table->string('data01')->nullable();
            $table->string('data02')->nullable();
            $table->string('data03')->nullable();
            $table->integer('brand_id'); ///brand=> id
            $table->integer('supplier_id'); ///brand=> id
            $table->integer('stockLevel')->nullable();
            $table->integer('priceIncl')->nullable();
            $table->string('sku')->nullable();
            $table->string('ean')->nullable();
            $table->string('articleCode')->nullable();
            $table->string('priceExcl')->nullable();
            /// // variants?product=71488622

        });
    }


    public function down()
    {
        Schema::dropIfExists('store_products');
    }
}
