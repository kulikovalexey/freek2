<?php

namespace App\Http\Controllers;

use App\Classes\LightspeedhqApi\Variants;
use App\Classes\LightspeedhqApi\Worker;
use App\StoreProduct;
use App\Repository\BrandRepository;

class StoreController extends Controller
{
    protected $request;
    protected $response;

 public function __construct()
 {

 }

    public function importProducts()
    {

        //$data = (new Worker())->getAllProducts();
//        $data = (new Worker())->getAllProducts();

//        $products = StoreProduct::getProducts();


        $data = (new Worker())->buildVariantsData();
        print_r($data);

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