<?php

namespace App\Http\Controllers;

use App\Repository\SupplierRepositoryFactory;
use App\Classes\SupplierData\SupplierData;
use App\Classes\Loader\Loader;
use App\Classes\Parser\Parser;
use Illuminate\Http\Request;

class ImportController extends Controller
{

    protected $request;
    protected $response;
    protected $suppliers;
    protected $args;

    public function import(Request $request, $supplier)
    {
        $supplierData = new SupplierData(
            $this->getConfigSuppliers($supplier)
        );

//        (new Loader())->downloadFile($supplierData); // :TODO uncomment
        $data = (new Parser())->parse($supplierData);

        $supplierRepository = (new SupplierRepositoryFactory())->makeSupplierRepository($supplierData);
        $supplierRepository->saveLoadingData($data, $supplierData);
    }

    protected function getConfigSuppliers($supplier)
    {
        return config("suppliers.{$supplier}");
    }



}