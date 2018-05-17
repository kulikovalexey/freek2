<?php

namespace App\Repository;

use App\Supplier4Product;

class Supplier4Repository extends AbstractRepository
{
    /**
     * @param $data
     */
    public function saveLoadingData($data)   //:TODO решить что принять за первичный все таки
    {
        Supplier4Product::truncate();

        foreach ($data as $item) {
            if (empty($item['ean']) && empty($item['sku'])) continue;
            if (!in_array(strtolower($this->brands), $this->supplierData->brands)) continue;

            $item['priceIncl'] = $this->calculatePrice($item['priceIncl']);
            Supplier4Product::create($item);
        }
    }

    /**
     *
     */
    protected function calculatePrice($price)
    {
        if (! $this->isBrandInBlacklist()) {

            return $price;

        } elseif (($price * 1.02 + 7.50) * 1.21 >= 50) {  //:TODO in method maybe

            return floor(($price * 1.02 + 7.50) * 1.21 * 2) / 2;

        }

    }


}
