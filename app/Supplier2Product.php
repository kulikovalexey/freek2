<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * API BV
 *
 * Class Supplier2Products
 */
class Supplier2Product extends Model
{
    protected $table = 'supplier2_products';

    protected $fillable = ['sku', 'articleCode', 'ean', 'priceIncl', 'stockLevel', 'brand', 'name'];
}