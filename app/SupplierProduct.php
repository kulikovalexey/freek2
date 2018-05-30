<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Real Solutions Haarlem
 *
 * Class Supplier1Products
 */
class SupplierProduct extends Model
{
    public $timestamps = false;

    protected $table = 'supplier_products';

    protected $fillable = ['sku', 'articleCode', 'ean', 'priceIncl', 'stockLevel', 'brand', 'name', 'yourPriceExVatEur', 'supplier_id', 'priceIncl_origin'];

    public function variant()
    {
        return $this->belongsTo('App\Variant', 'articleCode', 'articleCode');

    }

}
