<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $timestamps = false;

    protected $fillable = ['id', 'name'];

    public function products()
    {
        return $this->hasMany('App\StoreProduct', 'brand_id', 'id');
    }

}