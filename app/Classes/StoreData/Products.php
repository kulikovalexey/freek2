<?php

namespace App\Classes\StoreData;

use App\StoreProduct;
use ShopApi;

class Products implements \App\Classes\StoreData\ItemInterface
{
    public function getAll()
    {
        $numberOfProducts = $this->getNumberOf();
        $pages = ceil($numberOfProducts / 255);


        $products = [];
        for ($i = 0; $i < $pages; $i++) {
            // тут надо сразу сохранять
            $newProducts = ShopApi::products()->get(null, [
                'page' => $i,
                'fields' => "id,createdAt,updatedAt,visibility,data01,data02,data03,title,brand,supplier",
                'limit' => 255
            ]);

            $products = array_merge($products, $newProducts);

        }
        return $products;
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

$newStoreProduct = new StoreProduct();
////                $newStoreProduct->_id = $productsInfo[$j]['id'];
////                $newStoreProduct->createdAt = $productsInfo[$j]['createdAt'];
////                $newStoreProduct->updatedAt = $productsInfo[$j]['updatedAt'];
////                $newStoreProduct->visibility = $productsInfo[$j]['visibility'];
////                $newStoreProduct->data01 = $productsInfo[$j]['data01'];
////                $newStoreProduct->data02 = $productsInfo[$j]['data02'];
////                $newStoreProduct->data03 = $productsInfo[$j]['data03'];
////                $newStoreProduct->name = $productsInfo[$j]['title'];
////                $newStoreProduct->brand_id = $productsInfo[$j]['brand']['resource']['id']; //
////                $newStoreProduct->supplier_id = $productsInfo[$j]['supplier']['resource']['id'];  //