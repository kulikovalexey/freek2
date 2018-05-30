<?php

namespace App\Repository;

use App\SupplierProduct;

class Supplier3Repository extends AbstractRepository
{
    /**
     * @param $data
     */
    public function saveLoadingData($data, $supplierData)
    {
//        $this->removeOldData($supplierData);
//           $this->removeOldData($supplierData);
//        print_r($data);

//        foreach ($data as $item){
//
//            $supplier = new Supplier2Product;
//
//            $supplier->sku = $item['sku'];
//            $supplier->articleCode = $item['articleCode'];
//            $supplier->ean = $item['ean'];
//            $supplier->priceIncl = $item['priceIncl'];
//            $supplier->stockLevel = $item['stockLevel'];
//            $supplier->brand = $item['brand'];
//            $supplier->name = $item['name'];
//
//
////                var_dump($supplier);
//            $supplier->save();
//            unset($supplier);
////            exit;

        $this->removeOldData($supplierData);

        $generator = $this->generator($data);
        foreach ($generator as $item) {
            if (!isset($item['ean']) && !isset($item['sku'])) {
                continue;
            }
            if (!in_array(strtolower($item['brand']), $this->brands)) {
                continue;
            }

            $item['priceIncl_origin'] = $item['priceIncl'];
            $item['priceIncl']        = $this->calculatePrice($item['priceIncl']);
            $item['supplier_id']      = $supplierData->id;

            SupplierProduct::create($item);
        }

    }

    /**
     * @param $price
     * @return float
     */
    protected function calculatePrice($price)
    {
        return $this->roundPriceDown(($price * 1.02 + 7.50) * 1.21);
    }



}