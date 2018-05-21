<?php

namespace App\Repository;

use App\Variant;
use PHPUnit\Runner\Exception;

class VariantRepository
{

    public function saveLoadingData($data)   //:TODO решить что принять за первичный все таки
    {
        Variant::truncate();

        foreach ($data as &$v) {
            $v['_id'] = $v['id'];unset($v['id']);
            $v['product_id'] = $v['product']['resource']['id']; unset($v['product']);

//            echo '========';
//            print_r($v);
//            echo '========';

        }
        Variant::insert($data);

    }
}

///** 'id', 'articleCode', 'ean', 'sku', 'priceIncl',
//        'stockLevel', 'product_id',


/**
$variant = new Variant();
$variant->_id = $v['id'];
$variant->articleCode = $v['articleCode'];
$variant->ean = $v['ean'];
$variant->sku = $v['sku'];
$variant->priceIncl = $v['priceIncl'];
$variant->stockLevel = $v['stockLevel'];
$variant->product_id = $v['product']['resource']['id'];
$variant->save();
 */