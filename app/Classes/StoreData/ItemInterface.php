<?php

namespace App\Classes\StoreData;

Interface ItemInterface
{
    public function getItem($id);

    public function getAll();

    public static function getNumberOf();

    public function create();


}