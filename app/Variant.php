<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    public $timestamps = false;

    protected $table = 'variants';

    protected $fillable = [
        'id', 'articleCode', 'ean', 'sku', 'priceIncl',
        'stockLevel', 'product_id',
    ];
}