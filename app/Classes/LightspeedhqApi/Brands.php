<?php

namespace App\Classes\LightspeedhqApi;

use App\StoreProduct;
use ShopApi;

class Brands
{
    /**
     * @link https://developers.lightspeedhq.com/ecom/endpoints/brand/
     *
     * @return mixed
     */
    public function getAllBrands() //:TODO переделать
    {
        $cnt = $this->getNumberOfBrands();
        $pages = ceil($cnt / 50);
        $brands = [];
        for ($i = 1; $i <= $pages; $i++) {

            $arr = (ShopApi::brands()->get(null, ['page' => $i]));

            $brands = array_merge($brands, $arr);
            unset($arr);
        }
        return $brands;
    }

    /**
     * return number of brands
     *
     * @link https://developers.lightspeedhq.com/ecom/endpoints/brand/
     * @return int
     */
    public static function getNumberOfBrands()
    {
        return ShopApi::brands()->count();
    }

    /**
     * @link https://developers.lightspeedhq.com/ecom/endpoints/brand/
     */
    public function createBrand()
    {

    }
}