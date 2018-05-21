<?php

namespace App\Http\Controllers;

use App\Supplier4Product;
use App\Classes\StoreData\Worker;
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

    public function showSupplier()
    {
        $info = config('suppliers.supplier4');


        return view('supplier.info', [
            'info' => $info,
        ]);
    }




}