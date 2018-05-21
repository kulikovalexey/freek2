<?php

namespace App\Repository;

use App\Variant;
use PHPUnit\Runner\Exception;

class VariantRepository
{

    public function saveLoadingData($data)   //:TODO первичный кл., исключения повесить
    {
        Variant::truncate();

        foreach ($data as &$v) {
            $v['_id'] = $v['id'];unset($v['id']);
            $v['product_id'] = $v['product']['resource']['id']; unset($v['product']);
        }
        Variant::insert($data);
    }
}