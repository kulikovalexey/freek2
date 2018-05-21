<?php

namespace App\Classes\Parser;

use App\Classes\SupplierData\AbstractSupplierData;
use App\Supplier4Product;

class ParserXML implements ParserInterface
{
    protected $supplier;

    public function parse(AbstractSupplierData $supplierData)
    {

        $filePath = $this->setFilePath($supplierData->fileName);

        if (file_exists($filePath)) {


            $arrColumns = $supplierData->dataProducts;
            $arrColumns = array_flip($arrColumns);

            $xml = simplexml_load_file($filePath, 'SimpleXMLElement', LIBXML_NOCDATA);

            if (!$xml) {
                foreach (libxml_get_errors() as $error) {
                    Log::error('Error loading XML:' . $error->message);
                    return false;
                }
            } else {
                $cnt = 0;

                foreach ($xml->product as $item) {
                    if (empty($item)) $cnt++;

                }
//
                foreach ($xml->product as $item) {
                    $product = new Supplier4Product();

                    $product->sku = $item->product_code;
                    $product->articleCode = $item->product_id;
                    $product->ean = $item->ean;
                    $product->priceIncl = $item->prijs;
                    $product->stockLevel = $item->stock;
                    $product->brand = $item->brand;
                    $product->name = $item->product_name;
                    $product->save();
                }
//
//
//                }


//
//
//                    foreach ($productParse as $k => $v){
//
//                        echo $productParse->$arrColumns[$k];
//
//                    }
//
//
//                    $arrColumns = $supplierData->dataProducts;
//                    $columnsList = array_values($arrColumns);
//
//                    array_walk($csv->data, function (&$a) use ($columnsList) {
//                        foreach ($a as $k => $v){
//                            if (!in_array($k, $columnsList)) {
//                                unset ($a[$k]);
//                            }
//                        }
//                    });
//
//
//
//                    array_walk($csv->data, function (&$a) use ($arrColumns) {
//                        foreach ($a as $k => $v){
//                            if($arrColumns[$k] !== $k) {
//                                $a[$arrColumns[$k]] = $a[$k];
//                                unset ($a[$k]);
//                            }
//                        }
//                    });
                //   }

            }
            exit;

        }


    }


    protected function setFilePath($fileName, $storagePath = '..' . DIRECTORY_SEPARATOR . 'tmp')  //:TODO refactoring
    {
        return $storagePath . DIRECTORY_SEPARATOR . $fileName;
    }


}