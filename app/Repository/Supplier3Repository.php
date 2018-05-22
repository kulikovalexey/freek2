<?php

namespace App\Repository;

class Supplier3Repository extends AbstractRepository
{
    /**
     * @param $data
     */
    public function saveLoadingData($data, $supplierData)
    {
    //       Supplier3Product::truncate();
//        print_r($data);
//
////        foreach ($data as $item){
////
////            $supplier = new Supplier2Product;
////
////            $supplier->sku = $item['sku'];
////            $supplier->articleCode = $item['articleCode'];
////            $supplier->ean = $item['ean'];
////            $supplier->priceIncl = $item['priceIncl'];
////            $supplier->stockLevel = $item['stockLevel'];
////            $supplier->brand = $item['brand'];
////            $supplier->name = $item['name'];
////
////
//////                var_dump($supplier);
////            $supplier->save();
////            unset($supplier);
//////            exit;
//
    }

    /**
     * @param $price
     * @return float|int
     */
    protected function calculatePrice($price)
    {
        if (!$this->isBrandInBlacklist()) {

            return $price;

        } elseif (($price * 1.02 + 7.50) * 1.21 >= 50){

            return floor(($price * 1.02 + 7.50) * 1.21);

        } else {

            return floor(($price * 1.02 + 7.50) * 1.21 * 2) / 2;

        }
    }



}