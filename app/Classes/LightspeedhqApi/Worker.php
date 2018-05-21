<?php

namespace App\Classes\LightspeedhqApi;

use App\StoreProduct;
use App\Classes\LightspeedhqApi\Brands;
use App\Classes\LightspeedhqApi\Products;
use App\Classes\LightspeedhqApi\Variants;
use ShopApi;

class Worker
{
    protected $variants;
    protected $products;
    protected $brands;

    public function __construct()
    {
        $this->brands = new Brands;
        $this->products = new Products;
        $this->variants = new Variants();
    }

    function buildVariantsData()
    {
        echo "Building Variants Mapping Data";
        // Truncate all databases
//        $count = $api->products->count();
        $count = $this->products->getNumberOfProducts();

        echo "Store has $count products<br>";
//        $count = $api->variants->count();
        $count = $this->variants->getNumberOfVariants();
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



//https://4351c23a915454284ccacd758306cb21:7727b3f260788b7af9b0fda65b360556@api.webshopapp.com/nl/products.json


        // https://4351c23a915454284ccacd758306cb21:7727b3f260788b7af9b0fda65b360556@api.webshopapp.com/nl/categories/products.json?product=57409802

// all products
//curl --user 4351c23a915454284ccacd758306cb21:7727b3f260788b7af9b0fda65b360556 \ https://api.webshopapp.com/nl/products.json


//number of products
// https://4351c23a915454284ccacd758306cb21:7727b3f260788b7af9b0fda65b360556@api.webshopapp.com/nl/products/count.json


// product
// https://4351c23a915454284ccacd758306cb21:7727b3f260788b7af9b0fda65b360556@api.webshopapp.com/nl/products/57409802.json
//curl --user 4351c23a915454284ccacd758306cb21:7727b3f260788b7af9b0fda65b360556 \ https://api.webshopapp.com/nl/products/69085343.json


//variants
//        https://4351c23a915454284ccacd758306cb21:7727b3f260788b7af9b0fda65b360556@api.webshopapp.com/nl/variants.json?product=71384033

//brands
// https://4351c23a915454284ccacd758306cb21:7727b3f260788b7af9b0fda65b360556@api.webshopapp.com/nl/brands.json
//curl --user 4351c23a915454284ccacd758306cb21:7727b3f260788b7af9b0fda65b360556 \ https://api.webshopapp.com/nl/products/69085343.json


// brand
// https://4351c23a915454284ccacd758306cb21:7727b3f260788b7af9b0fda65b360556@api.webshopapp.com/nl/brands/2546135.json
//curl --user 4351c23a915454284ccacd758306cb21:7727b3f260788b7af9b0fda65b360556 \ https://api.webshopapp.com/nl/brands/2546135.json

// number of brands {"count":75}
//https://4351c23a915454284ccacd758306cb21:7727b3f260788b7af9b0fda65b360556@api.webshopapp.com/nl/brands/count.json

//curl --user 4351c23a915454284ccacd758306cb21:7727b3f260788b7af9b0fda65b360556 \ https://api.webshopapp.com/nl/brands/count.json


    protected function setFilePath($fileName, $storagePath = '..'. DIRECTORY_SEPARATOR . 'tmp')  //:TODO refactoring
    {
        return  $storagePath . DIRECTORY_SEPARATOR . $fileName;
    }

    protected function deleteOldFile($filePath)
    {
        unlink($filePath);
    }

    protected function checkFile($filePath)
    {
        if (! file_exists($filePath))
            throw new \Exception('File not uploaded');
    }

    protected function returnJsonDecode($filePath)
    {
        return json_decode(file_get_contents($filePath));
    }
}