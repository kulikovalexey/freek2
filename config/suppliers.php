<?php

return [
    'supplier1' => [
        '_name' => 'supplier1',
        'id'      => 9183,
        'name'    => 'Real Solutions Haarlem',
        'url'     => 'https://shop.rshaarlem.com/pricefeed.php?u=info@mymediacenter.nl&p=cae66ffb0eb43ae063ebf632eca7f1c2:a7',
        'fileName' => 'supplier1.csv',
        'fileType' => 'csv',
        'delimiter'=> '\t',
        'dataProducts' => [
            'sku'         => 'Vendorcode',
            'articleCode' => 'Vendor SKU',
            'ean'         => 'EAN code',
            'priceIncl'   => 'SRP price ex. VAT EUR',
            'stockLevel'  => 'Stock',
            'brand'       => 'Brand',
            'name'        => 'Name',
            'yourPriceExVatEur' => 'Your price ex. VAT EUR',
        ],
        'brands' => [
            'synology',
            'g-technology',
            'hikvision',
            'foscam',
            'asustor'
        ],
    ],
    'supplier2' => [
        '_name' => 'supplier2',
        'id'      => 367457,
        'name'    => 'API BV',
        'url'     => 'http://tariff.fuman.de/pricelist/?cid=158895&cpw=5706ME31&shop=apibv',
        'fileName' => 'supplier2.csv',
        'fileType' => 'csv',
        'delimiter'=> ';',
        'dataProducts' => [
            'sku'         => 'msku',
            'articleCode' => 'sku',
            'ean'         => 'ean',
            'priceIncl'   => 'price',
            'stockLevel'  => 'stock',
            'brand'       => 'manufacturer',
            'name'        => 'title',
        ],
        'brands' => [
            'apple',
            'hgst',
            'asus',
            'toshiba',
            'western digital',
            'buffalo',
            'linksys',
            'crucial',
            'sapphire',
            'intel',
            'dell',
        ],
    ],
    'supplier3' => [
        '_name' => 'supplier3',
        'id'      => 9264,
        'name'    => 'Valadis',
        'url'     => 'https://etail.valadis.nl:444/prijslijst.csv',
        'fileName' => 'supplier3.csv',
        'fileType' => 'csv',
        'delimiter'=> ';',
                                    //$fromFields = "7,          5,            4,        1";
                                    //$toFields = "articleCode, stockLevel, priceIncl, sku";

        'dataProducts' => [
            'brand',
            'sku',//         => '1',
            'name', //       => '2',
            'priceIncl', // => '4',
            'stockLevel', // => '5',
            'skip',  // ====
            'articleCode',// => '7',
//            'ean'         => '',
            'skip',        // => '8',
            'skip',        // => '9',

        ],
        'brands' => [
            'yealink',
            'engenius',
            'zyxel',
            'panasonic',
            'gigaset',
            'snom',
        ],
    ],
    'supplier4' => [
        '_name' => 'supplier4',
        'id'      => 441980,
        'name'    => 'Wimood',
        'url'     => 'https://wimoodshop.nl/api/index.php?api_key=BhvsskAFQQqR72CtJrCJ86A3JwLb9a&klantnummer=5730',
        'fileName' => 'supplier4.xml',
        'fileType' => 'xml',
        'delimiter'=> '',
        'dataProducts' => [
            'sku'         => 'product_code',
            'articleCode' => 'product_id',
            'ean'         => 'ean',
            'priceIncl'   => 'prijs',
            'stockLevel'  => 'stock',
            'brand'       => 'brand',
            'name'        => 'product_name',
        ],
        'brands' => [
            'mikrotik',
            'ubiquiti'
        ]
    ],
];