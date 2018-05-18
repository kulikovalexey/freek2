<?php

namespace App\Http\Controllers;

use App\Supplier2Product;
use App\Classes\LightspeedhqApi\Worker;
use App\Repository\BrandRepository;

class Supplier2Controller extends Controller
{

    public function index()
    {
        $suppliers = Supplier2Product::paginate(20);


        return view('supplier.index', [
            'suppliers' => $suppliers,
        ]);
    }





}