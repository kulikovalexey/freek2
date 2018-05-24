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

        foreach ($data as $item) {
            if (empty($item['ean']) && empty($item['sku'])) continue;
            if (!in_array(strtolower($item['brand']), $this->supplierData->brands)) continue;

            $item['priceIncl'] = $this->calculatePrice($item['priceIncl']);
            SupplierProduct::create($item);
        }
    }

    /**
     *
     */
    protected function calculatePrice($price, $brand = null)
    {
        if (($price * 1.02 + 7.50) * 1.21 >= 50) {

            return floor(($price * 1.02 + 7.50) * 1.21);

        } else {

            return floor(($price * 1.02 + 7.50) * 1.21 * 2) / 2;
        }

    }


/*




if(!isset($item->product_code) && !isset($item->ean) ) continue;

$product = new SupplierProduct();


$product->sku = $item->product_code;
$product->articleCode = $item->product_id;
$product->ean = $item->ean;
$product->priceIncl = (float)$item->prijs;
$product->stockLevel = $item->stock;
$product->brand = $item->brand;
$product->name = $item->product_name;
$product->supplier_id = $supplierData->id;

$product->save();
}*/

}
