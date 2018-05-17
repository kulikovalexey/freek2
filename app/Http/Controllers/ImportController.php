<?php

namespace App\Http\Controllers;

use App\Repository\SupplierRepositoryFactory;
use App\Classes\Supplier\SupplierData;
use App\Classes\Loader\Loader;
use App\Classes\Parser\Parser;

class ImportController extends Controller
{

    protected $request;
    protected $response;
    protected $suppliers;
    protected $args;

    public function import($args)
    {
        $supplierData = new SupplierData(
            $this->getConfigSuppliers($args)
        );

//        (new Loader())->downloadFile($supplierData); // :TODO uncomment
        $data = (new Parser())->parse($supplierData);

        $supplierRepository = (new SupplierRepositoryFactory())->makeSupplierRepository($supplierData);
        $supplierRepository->saveLoadingData($data, $supplierData);
    }

    protected function getConfigSuppliers($args)
    {
        return $GLOBALS['configSuppliers'][$args['supplier']];
    }



}