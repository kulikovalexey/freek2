<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplier4ProductsTable extends Migration
{
    /**
     * supplier4 products
     *
     * product_id 18
     * product_name N-Male <> SMA-RP Male 25 cm
     * stock 120
     * msrp 8
     * prijs 4
     */
    public function up()
    {
        Schema::create('supplier4_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku')->nullable();
            $table->string('articleCode');
            $table->string('ean')->nullable();
            $table->string('brand')->nullable();
            $table->string('name');
            $table->float('priceIncl');
            $table->integer('stockLevel')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('supplier4_products');
    }
}
