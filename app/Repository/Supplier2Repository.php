<?php

namespace App\Repository;

use App\SupplierProduct;

class Supplier2Repository extends AbstractRepository
{

    public function saveLoadingData($data, $supplierData)
    {
        $this->removeOldData($supplierData);

        $generator = $this->generator($data);
        foreach ($generator as $item) {
            if (!isset($item['ean']) && !isset($item['sku'])) {
                continue;
            }
            if (!in_array(strtolower($item['brand']), $this->supplierData->brands)) {
                continue;
            }
            if ($item['priceIncl'] == 99999.99) {
                continue;
            }

            $item['priceIncl_origin'] = $item['priceIncl'];
            $item['priceIncl']        = $this->calculatePrice($item['priceIncl']);
            $item['supplier_id']      = $supplierData->id;

            SupplierProduct::create($item);
        }
    }

    /**
     * after review
     * @param $price
     * @return float
     *
     * priceIncl should be:
     * (price + 3% + 7,50) + 21%. For every brand I use.
     */
    protected function calculatePrice($price, $brand = null, $yourPriceExVatEur = null)
    {
        return $this->roundPriceDown(($price * 1.03 + 7.50) * 1.21);
    }
}
