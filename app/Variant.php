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
        return $this->belongsTo(StoreProduct::class, 'product_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function supplierProduct()
    {
        return $this->hasOne('App\SupplierProduct', 'articleCode','articleCode');
    }
}