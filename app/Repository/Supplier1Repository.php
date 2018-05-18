<?php

namespace App\Repository;

use App\Classes\Supplier\AbstractSupplierData;
use App\Supplier1Product;
use PHPUnit\Runner\Exception;

class Supplier1Repository extends AbstractRepository
{

    public function saveLoadingData($data)   //:TODO решить что принять за первичный все таки
    {
        Supplier1Product::truncate();

        foreach ($data as $item){
            if (empty($item['ean']) && empty($item['sku'])) continue;

            $item['priceIncl'] = $this->calculatePrice($item['priceIncl'], $item['brand']);
            Supplier1Product::create($item);
        }

    }

    /**
     * @param $price
     * @param $brand
     * @return float|int
     */
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

    protected function isBrandInBlacklist($brand){
        return (! in_array(strtolower($brand), $this->supplierData->exceptBrands));
    }


}

/*

 [sku] => TD108R1X
            [articleCode] => RSH-2898
            [ean] =>
            [priceIncl] => 0.50
            [stockLevel] => 36
            [brand] => ACT
            [name] => RJ-45 (8P/8C) Connector voor soepele aders 1 stuk

 */