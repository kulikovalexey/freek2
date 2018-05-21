<?php

namespace App\Classes\LightspeedhqApi;

use App\StoreProduct;
use ShopApi;

class Variants implements  \App\Classes\LightspeedhqApi\ItemInterface
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
            if ($i++ > 20) {  //:TODO refactoring
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
            echo $count . '<br>';
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