<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Classes\StoreData\Brands;
//use App\Classes\SupplierData\SupplierData;
//use App\Classes\Parser\Parser;
//use App\Classes\StoreData\Products;
//use App\Classes\StoreData\Variants;
//use App\Repository\SupplierRepositoryFactory;
//use App\Repository\StoreProductRepository;
//use App\Repository\VariantRepository;
//use App\Repository\BrandRepository;
use ShopApi;

class SyncController extends Controller
{

    protected $request;
    protected $response;
    protected $suppliers;
    protected $args;



    // выбрать все данные
    public function index()
    {

    }




//
//    public function syncStoreBrands()
//    {
////
//    }
//
//    public function syncStoreProducts()
//    {
////
//    }



    // :TODO rebase all to repositories

    public function createProduct()
    {
        //:TODO добавился //72001535
//        $resp =ShopApi::products()->create([
//            "visibility"    => "hidden",
//            "data01"        => "",
//            "data02"        => "",
//            "data03"        => "",
//            "title"         => "TEST_title",
//            "fulltitle"     => "TEST_fulltitle",
//            "description"   => "TEST_description",
//            "content"       => "TEST_CONTENT",
//            "deliverydate"  => 1,
//            "supplier"      => 2,
//            "brand"         => 3
//        ]);
//        print_r($resp);
    }



    public function updateProduct()  //remove test data
    {
        $resp = ShopApi::products()->update('72001535', [
            "title"         => "TEST_title_updated",
            "fulltitle"     => "TEST_fulltitle_updated",
            "description"   => "TEST_description_updated",
            "content"       => "TEST_CONTENT_updated",
        ]);

        print_r($resp);
    }


    public function deleteProduct()
    {
        $product_id = 72001535;
        $resp = ShopApi::products()->delete($product_id);
        print_r($resp);
    }


    protected function getConfigSuppliers($supplier)
    {
        return config("suppliers.{$supplier}");
    }





}