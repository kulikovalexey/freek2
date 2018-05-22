<?php

namespace App\Http\Controllers;

use App\StoreProduct;
use App\Supplier1Product;
use App\Classes\StoreData\Worker;
use App\Repository\BrandRepository;

class StoreProductController extends Controller   //:TODO в фабрику
{

    public function index()
    {
        $products = StoreProduct::paginate(20);


        return view('products.index', [
            'products' => $products,
        ]);
    }


    public function showSupplier()
    {
        $info = config('suppliers.supplier1');


        return view('supplier.info', [
            'info' => $info,
        ]);
    }

    //for hands

    public function updatePrice()
    {

        \App\Supplier1Product::chunk(200, function ($products) {
            foreach ($products as $product) {
                $product->priceIncl = 11111;
                $product->save();
            }
        });
    }

    protected function calculatePrice($price, $brand)
    {
        if ($this->isPriceMoreThan250($price) && $this->isBrandInBlacklist($brand)){

            return floor( $price * 1.21);

        } elseif ( $price * 1.21 >= 50){

            return floor( $price * 1.21);

        } else {

            return (floor( $price * 1.21)) / 2;
        }
    }

    private function isPriceMoreThan250($price){
        return ($price > 250);
    }



}