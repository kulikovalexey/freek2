<?php

namespace App\Http\Controllers;

use App\Classes\StoreData\Brands;
use Illuminate\Http\Request;
use App\Classes\SupplierData\SupplierData;
use App\Classes\Parser\Parser;
use App\Classes\StoreData\Products;
use App\Classes\StoreData\Variants;
use App\Repository\SupplierRepositoryFactory;
use App\Repository\StoreProductRepository;
use App\Repository\VariantRepository;
use App\Repository\BrandRepository;

class SyncController extends Controller
{

    protected $request;
    protected $response;
    protected $suppliers;
    protected $args;

    public function syncSupplierData(Request $request, $supplier)
    {
//        $supplierData = new SupplierData(
//            $this->getConfigSuppliers($supplier)
//        );
//
////        (new Loader())->downloadFile($supplierData); // :TODO uncomment
//        $data = (new Parser())->parse($supplierData);
//
//        $supplierRepository = (new SupplierRepositoryFactory())->makeSupplierRepository($supplierData);
//        $supplierRepository->saveLoadingData($data, $supplierData);
    }


    public function syncStoreBrands()
    {
//        $brandsData = (new Brands())->getAll();
//
//        (new BrandRepository())->saveBrands($brandsData);
    }

    public function syncStoreProducts()
    {
//        // api
//        $data = (new Products())->getAll();
//        (new StoreProductRepository())->saveLoadingData($data);
//
//        // api
//        $data = (new Variants())->getAll();
//        (new VariantRepository())->saveLoadingData($data);

    }




    protected function getConfigSuppliers($supplier)
    {
        return config("suppliers.{$supplier}");
    }





}