<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreProduct extends Model
{
    public $timestamps = false;

    protected $table = 'store_products';

    protected $fillable = [
        'id', 'name', 'createdAt', 'updatedAt', 'visibility',
        'data01','data02','data03','brand_id','supplier_id',
        'stockLevel', 'priceIncl', 'sku', 'ean', 'articleCode', 'priceExcl',
    ];

    public function brand()
    {
        return $this->belongsTo('App\Brand', 'brand_id','id');
    }

    public function supplierProduct()
    {
        return $this->hasMany('App\SupplierProduct', 'supplier_id', 'supplier_id');
    }

    public function variant()
    {
        return $this->hasOne(Variant::class, 'product_id', 'id');
    }
}