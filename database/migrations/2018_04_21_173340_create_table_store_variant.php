<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStoreVariant extends Migration
{
    public function up()
    {
        Schema::create('variants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('articleCode')->nullable();
            $table->string('ean')->nullable();
            $table->string('sku')->nullable();  //:TODO ключ?
            $table->integer('priceIncl')->nullable();
            $table->integer('stockLevel')->nullable();
            $table->integer('product_id')->nullable();

        });
    }


    public function down()
    {
        Schema::dropIfExists('variants');
    }
}
