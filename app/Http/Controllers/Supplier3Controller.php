<?php

namespace App\Http\Controllers;

use App\Supplier3Product;
use App\Classes\LightspeedhqApi\Worker;
use App\Repository\BrandRepository;

class Supplier3Controller extends Controller   //:TODO в фабрику
{

    public function index()
    {
        $suppliers = Supplier3Product::paginate(20);


        return view('supplier.index', [
            'suppliers' => $suppliers,
        ]);
    }





}