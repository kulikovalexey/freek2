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
        return strtolower(natsort($arr));
    }
}