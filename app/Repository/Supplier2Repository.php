<?php

namespace App\Repository;

use App\Supplier2Product;

class Supplier2Repository extends AbstractRepository
{

    public function saveLoadingData($data)   //:TODO решить что принять за первичный все таки
    {


        $this->truncateTable();

        foreach ($data as &$item) {
            if ($item['ean'] == false && $item['sku'] == false) unset($item);
//            if (!in_array(strtolower($item['brand']), $this->brands)) unset($item);
//            $item['priceIncl'] = $this->calculatePrice($item['priceIncl']);
        }

        foreach ($data as $item) {
            Supplier2Product::create($item);
        }
    }

    /**
     * @return string
     */
    public function truncateTable()
    {
        Supplier2Product::truncate();
    }


    /**
     * @param $price
     * @param null $brands
     * @return float
     */
    protected function calculatePrice($price, $brands = null)
    {
        if ($price == 99999.99){
            return $price;

        } elseif (($price * 1.03 + 7.50) * 1.21 >= 50) {

            return floor(($price * 1.03 + 7.50) * 1.21);

        } else {

            return (floor( $price * 1.03 + 7.50) * 1.21 * 2) / 2;

        }
    }



}

/**
'currency' => string 'EUR' (length=3)
'egId' => string '84735080' (length=8)
'lwg1' => string 'HDMI-Kabel' (length=10)
'availability' => string 'B' (length=1)
'weight' => string '0.100' (length=5)
'width' => string '0.150' (length=5)
'depth' => string '0.200' (length=5)
'height' => string '0.020' (length=5)
'externalStock' => string '0' (length=1)
'articleCode' => string 'CH0056' (length=6)
'priceIncl' => string '2.42' (length=4)
'stockLevel' => string '20' (length=2)
'brand' => string 'Logilink' (length=8)
'name' => string 'LogiLink HDMI-Kabel Ethernet


'sku'         => 'msku',
'articleCode' => 'sku',
'ean'         => 'ean',
'priceIncl'   => 'price',
'stockLevel'  => 'stock',
'brand'       => 'manufacturer',
'name'        => 'title',


 */
