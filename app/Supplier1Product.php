<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Real Solutions Haarlem
 *
 * Class Supplier1Products
 */
class Supplier1Product extends Model
{
    public $timestamps = false;

    protected $table = 'supplier1_products';

    protected $fillable = ['sku', 'articleCode', 'ean', 'priceIncl', 'stockLevel', 'brand', 'name', 'created_at', 'updated_at'];

}