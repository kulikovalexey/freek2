<?php

namespace App\Repository;

use App\SupplierProduct;

class Supplier1Repository extends AbstractRepository
{

    public function saveLoadingData($data, $supplierData)
    {
       $this->removeOldData($supplierData);

        $generator = $this->generator($data);

        foreach ($generator as $item){
            if (!isset($item['ean']) && !isset($item['sku'])) continue;
            $item['supplier_id'] = $supplierData->id;
            $item['priceIncl'] = $this->calculatePrice($item['priceIncl'], $item['brand']);

            SupplierProduct::create($item);
        }
    }

    /**
     * @param $price
     * @param $brand
     * @return float|int
     */
    protected function calculatePrice($price, $brand)
    {
        if ($this->isPriceMoreThan250($price) && $this->isInBrandList($brand)){

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

    protected function isInBrandList($brand){
        return in_array(strtolower($brand), $this->supplierData->brands);
    }

}