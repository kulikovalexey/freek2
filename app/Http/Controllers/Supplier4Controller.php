<?php

namespace App\Http\Controllers;

use App\Supplier4Product;
use App\Classes\LightspeedhqApi\Worker;
use App\Repository\BrandRepository;

class Supplier4Controller extends Controller   //:TODO в фабрику
{

    public function index()
    {
        $suppliers = Supplier4Product::paginate(20);


        return view('supplier.index', [
            'suppliers' => $suppliers,
        ]);
    }





}