<?php

namespace App\Classes\LightspeedhqApi;

use App\StoreProduct;
use ShopApi;

class Products implements \ItemInterface
{
    public function getAll()
    {
        $numberOfProducts = $this->getNumberOfProducts();
        $pages = ceil($numberOfProducts / 50);  // 95.94 50 штук на страницу 0-49  //:TODO оставить

        for ($i = 0; $i < $pages; $i++) {
            // тут надо сразу сохранять
            $productsInfo = ShopApi::products()->get(null, ['page' => $i, 'limit' => 1]);  //:TODO сразу сохранять

//            var_dump($productsInfo);
//
            $cnt = count($productsInfo);
            echo $cnt . '<br>';

            for ($j = 0; $j < $cnt; $j++) {
                echo $j  . '<br>';
                $newStoreProduct = new StoreProduct();
                $newStoreProduct->_id = $productsInfo[$j]['id'];
                $newStoreProduct->createdAt = $productsInfo[$j]['createdAt'];
                $newStoreProduct->updatedAt = $productsInfo[$j]['updatedAt'];
                $newStoreProduct->visibility = $productsInfo[$j]['visibility'];
                $newStoreProduct->data01 = $productsInfo[$j]['data01'];
                $newStoreProduct->data02 = $productsInfo[$j]['data02'];
                $newStoreProduct->data03 = $productsInfo[$j]['data03'];
                $newStoreProduct->name = $productsInfo[$j]['title'];
                $newStoreProduct->brand_id = $productsInfo[$j]['brand']['resource']['id']; //
                $newStoreProduct->supplier_id = $productsInfo[$j]['supplier']['resource']['id'];  //
                $newStoreProduct->save();

            }
            unset($productsInfo);
        }
    }

    /**
     * return count of brands
     *
     * @link https://developers.lightspeedhq.com/ecom/endpoints/brand/
     * @return int
     */
    public static function getNumberOf()
    {
        return ShopApi::products()->count();
    }

    /**
     * @link https://developers.lightspeedhq.com/ecom/endpoints/product/
     * @param $productId
     * @return mixed
     */
    public function getItem($productId)
    {
        return ShopApi::products()->get($productId);

    }

    /**
     * @link https://developers.lightspeedhq.com/ecom/endpoints/product/
     */
    public function create()
    {

    }
}