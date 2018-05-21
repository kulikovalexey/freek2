<?php

namespace App\Repository;

use App\Variant;
use PHPUnit\Runner\Exception;

class VariantRepository
{

    public function saveLoadingData($data)
    {
        Variant::truncate();

        foreach ($data as &$v) {
            $v['product_id'] = $v['product']['resource']['id']; unset($v['product']);
        }

        Variant::insert($data);
    }
}