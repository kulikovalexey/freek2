<?php

namespace App\Controllers;

use App\Classes\LightspeedhqApi\Worker;
use App\Models\StoreProduct;
use App\Repository\BrandRepository;

class StoreController extends BaseController
{

    protected $request;
    protected $response;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function importProducts()
    {

//        $data = (new Worker())->getProduct(70277705);
//        print_r($data);

        //$data = (new Worker())->getAllProducts();
        $data = (new Worker())->getAllProducts();

//        $products = StoreProduct::getProducts();

        print_r($data);

    }




    public function getAllBrands()
    {
        $data = (new Worker())->getAllBrands();

        (new BrandRepository())->saveBrands($data);
    }


}