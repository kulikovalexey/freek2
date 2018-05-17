<?php

return [
    'mainApiData' => [
        'name'    => 'mymediacenter',
        'url'     => 'api.webshopapp.com',
        'cluster' => 'eu1',
        'key'     => '4351c23a915454284ccacd758306cb21',
        'secret'  => '7727b3f260788b7af9b0fda65b360556',
        'language'=> 'nl',
        'dataProducts' => [
            'sku'         => '',
            'articleCode' => '',
            'ean'         => '',
            'priceIncl'   => '',
            'stockLevel'  => '', // :TODO will add name and brand
        ],
    ],
];


//https://4351c23a915454284ccacd758306cb21:7727b3f260788b7af9b0fda65b360556@api.webshopapp.com/nl/products.json


// all products
//curl --user 4351c23a915454284ccacd758306cb21:7727b3f260788b7af9b0fda65b360556 \ https://api.webshopapp.com/nl/products.json


// product
// https://4351c23a915454284ccacd758306cb21:7727b3f260788b7af9b0fda65b360556@api.webshopapp.com/nl/products/69085343.json
//curl --user 4351c23a915454284ccacd758306cb21:7727b3f260788b7af9b0fda65b360556 \ https://api.webshopapp.com/nl/products/69085343.json


//brands
// https://4351c23a915454284ccacd758306cb21:7727b3f260788b7af9b0fda65b360556@api.webshopapp.com/nl/brands.json
//curl --user 4351c23a915454284ccacd758306cb21:7727b3f260788b7af9b0fda65b360556 \ https://api.webshopapp.com/nl/products/69085343.json


// brand
// https://4351c23a915454284ccacd758306cb21:7727b3f260788b7af9b0fda65b360556@api.webshopapp.com/nl/brands/2546135.json
//curl --user 4351c23a915454284ccacd758306cb21:7727b3f260788b7af9b0fda65b360556 \ https://api.webshopapp.com/nl/brands/2546135.json

// number of brands {"count":75}
//https://4351c23a915454284ccacd758306cb21:7727b3f260788b7af9b0fda65b360556@api.webshopapp.com/nl/brands/count.json
//curl --user 4351c23a915454284ccacd758306cb21:7727b3f260788b7af9b0fda65b360556 \ https://api.webshopapp.com/nl/brands/count.json