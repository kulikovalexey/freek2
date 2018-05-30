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
            if (!in_array(strtolower($item['brand']), $this->brands)) {
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
     * @return string
     */
    public function truncateTable()
    {
        return Supplier2Product::truncate();
    }


//    /**before review
//     * @param $price
//     * @param null $brands
//     * @return float
//     */
//    protected function calculatePrice($price, $brands = null)
//    {
//       if (($price * 1.03 + 7.50) * 1.21 >= 50) {
//
//            return floor(($price * 1.03 + 7.50) * 1.21);
//
//       } else {
//
//            return (floor( $price * 1.03 + 7.50) * 1.21 * 2) / 2;
//
//       }
//    }

    /** after review
     * @param $price
     * @param null $brands
     * @return float
     *
     * priceIncl should be:
     * (price + 3% + 7,50) + 21%. For every brand I use.
     */
    protected function calculatePrice($price, $brands = null)
    {
        return $this->roundPriceDown(($price * 1.03 + 7.50) * 1.21);
    }
}
