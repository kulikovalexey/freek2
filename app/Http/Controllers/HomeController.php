<?php

namespace App\Http\Controllers;

use App\Repository\BrandRepository;
use Illuminate\Http\Request;
use App\StoreProduct;
use App\Brand;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function showStoreProducts()
    {
        $products = StoreProduct::paginate(20);

        return view('products.index', [
            'products' => $products,
        ]);
    }

    public function showStoreBrands()
    {
        $brands = Brand::paginate(20);

        return view('brand.index', [
            'brands' => $brands,
        ]);
    }

    public function compareProducts()   //:TODO тут связать
    {
        $products = StoreProduct::paginate();

        return view('products.compare', [
            'products' => $products,
        ]);
    }

}
