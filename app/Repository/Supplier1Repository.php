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

            $item['priceIncl_origin'] = $item['priceIncl'];
            $item['priceIncl']        = $this->calculatePrice($item['priceIncl'], $item['brand']);
            $item['supplier_id']      = $supplierData->id;

            SupplierProduct::create($item);
        }
    }

//    /**before review from lsc script
//     * @param $price
//     * @param $brand
//     * @return float|int
//     */
//    protected function calculatePrice($price, $brand)
//    {
//        if ($this->isPriceMoreThan250($price) && $this->isInBrandList($brand)){
//
//            return floor( $price * 1.21);
//
//        } elseif ( $price * 1.21 >= 50){
//
//            return floor( $price * 1.21);
//
//        } else {
//
//            return (floor( $price * 1.21)) / 2;
//        }
//    }


    /** after review
     * @param $price
     * @return boolFor
     * the brands synology, g-technology, hikvision, foscam, asustor the priceIncl should be:
     * SRP price ex. VAT EUR + 21% VAT
     * For every other brand the priceIncl should be
     * If 'Your price ex. VAT EUR" = 250 or more then "Your price ex. VAT EUR" +2%+21% VAT
     * If Your price ex. VAT EUR" = less then 250 then SRP price ex. VAT EUR + 21% VAT
     *
     * @param $price
     * @param $brand
     * @return float|int
     */
    protected function calculatePrice($price, $brand)
    {
        if ($this->isInBrandList($brand)){

            return $this->roundPriceDown($price * 1.21);

        } elseif ($this->isPriceMoreThan250($price)){

            return $this->roundPriceDown($price * 1.23);  //$price * (1 + 0.02 + 0.21)

        } else {

            return $this->roundPriceDown( $price * 1.21);
        }
    }

    private function isPriceMoreThan250($price){
        return ($price >= 250);
    }

    protected function isInBrandList($brand){
        return in_array(strtolower($brand), $this->supplierData->brands);
    }

}