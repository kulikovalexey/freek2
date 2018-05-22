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
        Supplier4Product::truncate();

        foreach ($data as $item) {
            if (empty($item['ean']) && empty($item['sku'])) continue;
            if (!in_array(strtolower($this->brands), $this->supplierData->brands)) continue;

            $item['priceIncl'] = $this->calculatePrice($item['priceIncl']);
            SupplierProduct::create($item);
        }
    }

    /**
     *
     */
    protected function calculatePrice($price)
    {
        if (! $this->isInBrandList()) {

            return $price;

        } elseif (($price * 1.02 + 7.50) * 1.21 >= 50) {  //:TODO in method maybe

            return floor(($price * 1.02 + 7.50) * 1.21 * 2) / 2;

        }

    }


}
