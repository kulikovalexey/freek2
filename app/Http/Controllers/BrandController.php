<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Classes\LightspeedhqApi\Worker;
use App\Repository\BrandRepository;

class BrandController extends Controller
{

    public function index()
    {
        $brands = Brand::paginate(20);

        return view('brand.index', [
            'brands' => $brands,
        ]);
    }


    public function downloadBrands()  //:TODO rename method (now download|save in to db|)
    {
        $brandsData = (new Worker())->getAllBrands();

        (new BrandRepository())->saveBrands($brandsData);

        print_r($brandsData);
    }


}