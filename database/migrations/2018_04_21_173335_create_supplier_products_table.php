<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierProductsTable extends Migration
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
        Schema::create('supplier_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku')->nullable();
            $table->string('articleCode');
            $table->string('ean')->nullable();
            $table->string('brand')->nullable();
            $table->string('name');
            $table->float('priceIncl')->nullable();
            $table->float('priceIncl_origin')->nullable();
            $table->integer('stockLevel')->nullable();
            $table->integer('supplier_id');
            $table->integer('yourPriceExVatEur')->nullable();

            $table->index('articleCode');
            $table->index('priceIncl');
            $table->index('stockLevel');
            $table->index('supplier_id');
        });
    }


    public function down()
    {
        Schema::dropIfExists('supplier_products');
    }
}
