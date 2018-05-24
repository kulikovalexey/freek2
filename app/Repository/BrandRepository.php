<?php

namespace App\Repository;

use App\Brand;

class BrandRepository
{

    /**
     * @param $brandsData
     */
    public function saveBrands($brandsData)
    {
        Brand::truncate();

        foreach ($brandsData as $item){

            $brand = new Brand();
            $brand->id = $item['id'];
            $brand->name = $item['title'];
            $brand->save();
        }
    }

    public static function getBrandNameList()
    {
        $arr = Brand::pluck('name')->toArray();

        $arr = array_map('strtolower', $arr);
        natsort($arr);
        return $arr;
    }
}