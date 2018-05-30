<?php

namespace App\Repository;

use App\SupplierProduct;

class Supplier4Repository extends AbstractRepository
{
    /**
     * @param $data
     * @param $supplierData
     */
    public function saveLoadingData($data, $supplierData)
    {
        $this->removeOldData($supplierData);


        $generator = $this->generator($data);

        foreach ($generator as $item) {
            if (empty($item['ean']) && empty($item['sku'])) continue;
            if (!in_array(strtolower($item['brand']), $this->supplierData->brands)) continue;

            $item['priceIncl_origin'] = $item['priceIncl'];
            $item['priceIncl']   = $this->calculatePrice($item['priceIncl']);
            $item['supplier_id'] = $supplierData->id;

            SupplierProduct::create($item);
        }
    }


    /**
     *
     */
    protected function calculatePrice($price, $brands = null)
    {
        return $this->roundPriceDown(($price * 1.03 + 7.50) * 1.21);
    }
}
