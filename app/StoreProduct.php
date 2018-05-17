<?php

namespace App;

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Capsule\Manager as DB;

class StoreProduct extends Model
{
    protected $table = 'store_products';

    protected $fillable = ['sku', 'articleCode', 'ean', 'priceIncl', 'stockLevel', 'brand', 'name'];


}