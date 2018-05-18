<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Valadis
 *
 * Class Supplier3Products
 */
class Supplier3Product extends Model
{
    public $timestamps = false;

    protected $table = 'supplier3_products';

    protected $fillable = ['sku', 'articleCode', 'ean', 'priceIncl', 'stockLevel', 'brand', 'name', 'created_at', 'updated_at'];
}