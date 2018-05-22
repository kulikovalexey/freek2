<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSuppliers extends Migration  //copy CreateTableStoreProduct for front
{
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('inside_name');

        });
    }


    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
}
/*
 *
 */