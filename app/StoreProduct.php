<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreProduct extends Model
{
    protected $table = 'store_products';

    protected $fillable = ['sku', 'articleCode', 'ean', 'priceIncl', 'stockLevel', 'brand', 'name'];


}