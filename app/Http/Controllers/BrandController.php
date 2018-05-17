<?php

namespace App\Http\Controllers;

use App\Classes\LightspeedhqApi\Worker;
use App\Repository\BrandRepository;

class BrandController extends Controller
{

    protected $request;
    protected $response;

    public function __construct($request, $response, $args)
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;
    }

    public function downloadBrands()  //:TODO rename method (now download|save in to db|)
    {
        $brandsData = (new Worker())->getAllBrands();

        (new BrandRepository())->saveBrands($brandsData);

        print_r($brandsData);


//        $supplier = (new SupplierFactory())->makeSupplier($this->args['supplier']);
//
//        //(new Loader())->downloadFile($supplier); :TODO расскомменировать. тут для тестирования
//        $data = (new Parser())->parse($supplier);
//        $data = (new ConverterToSupplierObject($supplier))->convertDataToSupplierObject($data);
//
//        $supplierRepositoryFactory = new SupplierRepositoryFactory();  //:TODO refactoring
//        $supplierRepository = $supplierRepositoryFactory->makeSupplierRepository($supplier);
    }


}