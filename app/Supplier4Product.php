<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;

/**
 * Wimood
 *
 * SupplierProducts4
 */
class Supplier4Product extends Model
{
    protected $table = 'supplier4_products';

    protected $fillable = ['sku', 'articleCode', 'ean', 'priceIncl', 'stockLevel', 'brand', 'name', 'created_at', 'updated_at'];
}