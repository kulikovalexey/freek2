<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableExportProduct extends Migration  //copy CreateTableStoreProduct for front
{
    public function up()
    {
        Schema::create('export_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('createdAt');
            $table->string('updatedAt');
            $table->string('visibility')->nullable();
            $table->string('data01')->nullable();
            $table->string('data02')->nullable();
            $table->string('data03')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->string('priceExcl')->nullable();  //:TODO remove
            /// // variants?product=71488622

        });
    }


    public function down()
    {
        Schema::dropIfExists('store_products_test');
    }
}
/*
 *
 */