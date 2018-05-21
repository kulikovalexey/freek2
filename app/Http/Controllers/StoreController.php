<?php

namespace App\Http\Controllers;

use App\Classes\LightspeedhqApi\Variants;
use App\Classes\LightspeedhqApi\Worker;
use App\Repository\VariantRepository;
use App\StoreProduct;
use App\Repository\BrandRepository;
use App\Variant;

class StoreController extends Controller
{
    protected $request;
    protected $response;

 public function __construct()
 {

 }

    public function importProducts()
    {

//        $data = (new Worker())->buildProductsData();

//        $products = StoreProduct::getProducts();
//
//
        //:TODO работает
        $data = (new Variants())->getAll();

        (new VariantRepository())->saveLoadingData($data);



    }




    public function getAllBrands()
    {
        $data = (new Worker())->getAllBrands();

        (new BrandRepository())->saveBrands($data);
    }

    public function getProductById()
    {
        //        $data = (new Worker())->getProduct(70277705);
//        print_r($data);
    }


}