<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplier1ProductsTable extends Migration
{
    /**
     * supplier1 products
     *
     * 'tab'
     * EAN code              = ean_code
     * Vendorcode            = vendor_code
     * Vendor SKU            = vendor_sku
     * Brand                 = brand
     * Name                  = name
     * SRP price ex.VAT EUR  = spr_price_ex_vat_eur
     * Your price ex.VAT EUR = your_price_ex_vat_eur
     * Stock                 = stock
     *
     * Migrate Up.
     */

    /**
     * configuration
     * @var
     */

    public function up()
    {
        Schema::create('supplier1_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku');
            $table->string('articleCode');
            $table->string('ean');
            $table->string('brand')->nullable();
            $table->string('name');
            $table->float('priceIncl');
            $table->integer('stockLevel')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('supplier1_products');
    }
}
