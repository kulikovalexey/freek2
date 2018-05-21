<?php

namespace App\Classes\StoreData;

use App\StoreProduct;
use ShopApi;

class Variants implements  \App\Classes\StoreData\ItemInterface
{

    function getItem($id)
    {
        // TODO: Implement getItem() method.
    }

    public function getAll()
    {
        $count = $this->getNumberOf();

        $i = 0;
        $products = [];

        while ($count > 0) {
            if ($i++ > 20) {
                echo "Error: Max fetch reached. Increase fetch data";
                break;
            }
            $newVariants = ShopApi::variants()->get(null, [
                'page' => $i,
                'fields' => "articleCode,sku,ean,priceIncl,id,product,stockLevel",
                'limit' => 255
            ]);

            $products = array_merge($products, $newVariants);
            $count -= 255;
        }

        return $products;

    }

    /**
     * get count variants
     * @return mixed
     */
    public static function getNumberOf()
    {
        return ShopApi::variants()->count();
    }

    public function create()
    {
        // TODO: Implement create() method.
    }
}