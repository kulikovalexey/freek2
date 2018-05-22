<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StoreProduct;

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
}
