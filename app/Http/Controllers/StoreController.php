<?php

namespace App\Http\Controllers;

use App\Classes\StoreData\Products;
use App\Classes\StoreData\Variants;
use App\Classes\StoreData\Worker;
use App\Repository\StoreProductRepository;
use App\Repository\VariantRepository;
use App\Repository\BrandRepository;

class StoreController extends Controller
{
    public function importProducts()
    {
        // api
        $data = (new Products())->getAll();
        (new StoreProductRepository())->saveLoadingData($data);

        // api
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