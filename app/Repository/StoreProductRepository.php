<?php

namespace App\Repository;

use App\StoreProduct;
use PHPUnit\Runner\Exception;

class StoreProductRepository
{
    const FIXED_PRICE = 'fixed_price'; // for update products

    public function saveLoadingData($data)
    {
        StoreProduct::truncate();

        foreach ($data as &$v) {
            $v['name']        = $v['title'];                      unset($v['title']);
            $v['brand_id']    = $v['brand']['resource']['id'];    unset($v['brand']);
            $v['supplier_id'] = $v['supplier']['resource']['id']; unset($v['supplier']);
            unset($v['createdAt']);
            unset($v['updatedAt']);
        }

        StoreProduct::insert($data);
    }
}