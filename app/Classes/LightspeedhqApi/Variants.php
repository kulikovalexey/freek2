<?php

namespace App\Classes\LightspeedhqApi;

use App\Classes\LightspeedhqApi\Products;
use App\StoreProduct;
use ShopApi;

class Variants
{
    function getVariantsData()
    {
        echo "Building Variants Mapping Data";
        // Truncate all databases
//        $count = $api->products->count();
        $count = Products::getNumberOfProducts();

        echo "Store has $count products<br>";
//        $count = $api->variants->count();
        $count = self::getNumberOfVariants();
        echo "Store has $count variants<br>";

        $i = 0;
        $products = array();
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

//		p("Fetching Variants", "hidden", $newVariants);
            $products = array_merge($products, $newVariants);
            $count -= 255;
        }
        print_r($products);

    }

    public static function getNumberOfVariants()
    {
        return ShopApi::variants()->count();
    }
}