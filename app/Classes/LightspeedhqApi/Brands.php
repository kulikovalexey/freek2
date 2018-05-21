<?php

namespace App\Classes\LightspeedhqApi;

use App\StoreProduct;
use ShopApi;

class Brands implements \ItemInterface
{
    public function getItem($id)
    {

    }

    /**
     * @link https://developers.lightspeedhq.com/ecom/endpoints/brand/
     *
     * @return mixed
     */
    public function getAll() //:TODO переделать
    {
        $cnt = $this->getNumberOf();
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
    public static function getNumberOf()
    {
        return ShopApi::brands()->count();
    }

    /**
     * @link https://developers.lightspeedhq.com/ecom/endpoints/brand/
     */
    public function create()
    {

    }

    /**
     * @link https://developers.lightspeedhq.com/ecom/endpoints/brand/
     */
    public function update()
    {

    }
}