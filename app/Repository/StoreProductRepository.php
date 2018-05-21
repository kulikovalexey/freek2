<?php

namespace App\Repository;

use App\StoreProduct;
use PHPUnit\Runner\Exception;

class StoreProductRepository
{

    public function saveLoadingData($data)   //:TODO решить что принять за первичный все таки
    {
        StoreProduct::truncate();

        foreach ($data as &$v) {
//            $v['_id'] = $v['id'];unset($v['id']);
//            $v['product_id'] = $v['product']['resource']['id']; unset($v['product']);

            echo '========';
            print_r($v);
            echo '========';

        }
        StoreProduct::insert($data);

    }
}



/*
 *

$table->integer('_id');
            $table->string('name');
            $table->string('createdAt');
            $table->string('updatedAt');
            $table->string('visibility')->nullable();
            $table->string('data01')->nullable();
            $table->string('data02')->nullable();
            $table->string('data03')->nullable();
            $table->integer('brand_id'); ///brand=> id
            $table->integer('supplier_id'); ///brand=> id



 *
 *
 *
 */