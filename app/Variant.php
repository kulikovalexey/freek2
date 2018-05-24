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

    public function storeProduct()
    {
        return $this->hasOne('App\StoreProduct', 'id','product_id');  //:TODO not working
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function supplier()
    {
        return $this->hasOne('App\SupplierProduct', 'articleCode','articleCode');
    }
}