<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;

/**
 * Real Solutions Haarlem
 *
 * Class Supplier1Products
 */
class Supplier1Product extends Model
{
    protected $table = 'supplier1_products';

    protected $fillable = ['sku', 'articleCode', 'ean', 'priceIncl', 'stockLevel', 'brand', 'name', 'created_at', 'updated_at'];

}