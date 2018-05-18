<?php

namespace App\Http\Controllers;

use App\Supplier1Product;
use App\Classes\LightspeedhqApi\Worker;
use App\Repository\BrandRepository;

class Supplier1Controller extends Controller   //:TODO в фабрику
{

    public function index()
    {
        $suppliers = Supplier1Product::paginate(20);


        return view('supplier.index', [
            'suppliers' => $suppliers,
        ]);
    }





}