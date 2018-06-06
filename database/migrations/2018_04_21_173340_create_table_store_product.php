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
            $table->string('name');
            $table->string('visibility')->nullable();
            $table->string('data01')->nullable();
            $table->string('data02')->nullable();
            $table->string('data03')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->string('priceExcl')->nullable();  //:TODO remove

            $table->index('supplier_id');
            $table->index('data02');
            $table->index('priceExcl');

        });
    }


    public function down()
    {
        Schema::dropIfExists('store_products');
    }
}
