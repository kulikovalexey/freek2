<?php

namespace App\Classes\LightspeedhqApi;

use App\Classes\LightspeedhqApi\WorkerInterface;
use WebshopappApiClient;

class Worker implements WorkerInterface
{
    protected $settings;
    protected $url;
    protected $api;

    public function __construct()
    {
        // :TODO rebase settings
        $cluster = 'eu1';
        $key = '4351c23a915454284ccacd758306cb21';
        $secret = '7727b3f260788b7af9b0fda65b360556';
        $language = 'nl';

        $this->api = new WebshopappApiClient(
            $cluster,
            $key,
            $secret,
            $language
        );

    }


    /*

    [id] => 71384033    ==============================
            [createdAt] => 2018-05-16T14:16:25+02:00
            [updatedAt] => 2018-05-16T14:16:26+02:00
            [isVisible] =>
            [visibility] => hidden    ==============================
            [hasMatrix] =>
            [data01] => MikroTik
            [data02] =>    ==============================
            [data03] =>
            [url] => sma-male-to-sma-male-cable-1m
            [title] => SMA male to SMA male cable (1m)    ==============================
            [fulltitle] => SMA male to SMA male cable (1m)
            [description] =>
            [content] =>
            [set] =>
            [brand] => Array    ==============================
                (
                    [resource] => Array
                        (
                            [id] => 1640303
                            [url] => brands/1640303
                            [link] => https://api.webshopapp.com/nl/brands/1640303.json
                        )

                )

            [categories] => Array
                (
                    [resource] => Array
                        (
                            [id] =>
                            [url] => categories/products?product=71384033
                            [link] => https://api.webshopapp.com/nl/categories/products.json?product=71384033
                        )

                )

            [deliverydate] =>
            [image] =>
            [images] =>
            [relations] => Array
                (
                    [resource] => Array
                        (
                            [id] =>
                            [url] => products/71384033/relations
                            [link] => https://api.webshopapp.com/nl/products/71384033/relations.json
                        )

                )

            [metafields] => Array
                (
                    [resource] => Array
                        (
                            [id] =>
                            [url] => products/71384033/metafields
                            [link] => https://api.webshopapp.com/nl/products/71384033/metafields.json
                        )

                )

            [reviews] => Array
                (
                    [resource] => Array
                        (
                            [id] =>
                            [url] => reviews?product=71384033
                            [link] => https://api.webshopapp.com/nl/reviews.json?product=71384033
                        )

                )

            [type] =>
            [attributes] => Array
                (
                    [resource] => Array
                        (
                            [id] =>
                            [url] => products/71384033/attributes
                            [link] => https://api.webshopapp.com/nl/products/71384033/attributes.json
                        )

                )

            [supplier] => Array    ==============================
                (
                    [resource] => Array
                        (
                            [id] => 441980
                            [url] => suppliers/441980
                            [link] => https://api.webshopapp.com/nl/suppliers/441980.json
                        )

                )

            [tags] => Array
                (
                    [resource] => Array
                        (
                            [id] =>
                            [url] => tags/products?product=71384033
                            [link] => https://api.webshopapp.com/nl/tags/products.json?product=71384033
                        )

                )

            [variants] => Array    ==============================
                (
                    [resource] => Array
                        (
                            [id] =>
                            [url] => variants?product=71384033
                            [link] => https://api.webshopapp.com/nl/variants.json?product=71384033
                        )

                )

            [movements] => Array
                (
                    [resource] => Array
                        (
                            [id] =>
                            [url] => variants/movements?product=71384033
                            [link] => https://api.webshopapp.com/nl/variants/movements.json?product=71384033
                        )

                )

        )


    */

    //:TODO save
    public function getAllProducts()
    {
//        $pages = ceil(4797 / 50);  // 95.94 50 штук на страницу 0-49  //:TODO оставить
        $pages = 1;  // 95.94 по 50 штук на страницу 0-49
        for ($i = 0; $i < $pages; $i++) {
            // тут надо сразу сохранять
            $productsInfo[] = $this->api->products->get(null, ['page' => $i]);
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
        return $this->api->products->get($productId);

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