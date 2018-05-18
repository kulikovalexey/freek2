<?php

namespace App\Classes\LightspeedhqApi;

use App\Classes\LightspeedhqApi\WorkerInterface;
use ShopApi;

class Worker implements WorkerInterface
{
    protected $settings;
    protected $url;
    protected $api;


    public function getAllProducts()
    {

        $pages = ceil(4797 / 250);  // 95.94 50 штук на страницу 0-49  //:TODO оставить
        for ($i = 0; $i < $pages; $i++) {
            // тут надо сразу сохранять
            $productsInfo[] = ShopApi::products()->get(null, array('page' => $i, 'limit' => 250));  //:TODO сразу сохранять
        }

        foreach ($productsInfo as $product) {
            echo '<pre>';
            print_r($product);
            echo '</pre>';
            echo '<br>';
        }

        exit;
    }

    /**
     * @link https://developers.lightspeedhq.com/ecom/endpoints/product/
     * @param $productId
     * @return mixed
     */
    public function getProduct($productId)
    {
        return ShopApi::products()->get($productId);

    }


    /**
     * @link https://developers.lightspeedhq.com/ecom/endpoints/brand/
     *
     * @return mixed
     */
    public function getAllBrands()
    {
        $cnt = $this->getNumberOfBrands();
        $pages = ceil($cnt/50);
        $brands = [];
        for ($i = 1; $i <= $pages; $i++) {

            $arr = ($this->api->brands->get(null, ['page' => $i]));

            $brands = array_merge($brands, $arr);
            unset($arr);
        }
        return $brands;
    }

    /**
     * return count of brands
     *
     * @link https://developers.lightspeedhq.com/ecom/endpoints/brand/
     * @return int
     */
    public function getNumberOfBrands()
    {
        return $this->api->brands->count();
    }


    /**
     * @link https://developers.lightspeedhq.com/ecom/endpoints/product/
     */
    public function createProduct()
    {

    }

    /**
     * @link https://developers.lightspeedhq.com/ecom/endpoints/brand/
     */
    public function createBrand()
    {

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