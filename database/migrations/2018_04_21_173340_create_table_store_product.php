<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStoreProduct extends Migration
{
    public function up()
    {
        Schema::create('store_product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
    }


    public function down()
    {
        Schema::dropIfExists('brands');
    }
}
