<?php

namespace App\Classes\Parser;

use App\Classes\SupplierData\AbstractSupplierData;
use App\SupplierProduct;

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

                $data = [];
                $i = 0;

                foreach ($xml->product as $item) {  //

                    // for supplier 4
                    if (!isset($item->product_code) && !isset($item->ean)) continue;

                    $data[$i]['sku'] = (string) $item->product_code;
                    $data[$i]['articleCode'] = (int) $item->product_id;
                    $data[$i]['ean'] = (string) $item->ean;
                    $data[$i]['priceIncl'] = (float)$item->prijs;
                    $data[$i]['stockLevel'] = (int) $item->stock;
                    $data[$i]['brand'] = (string) $item->brand;
                    $data[$i]['name'] = (string) $item->product_name;
                    $data[$i]['supplier_id'] = $supplierData->id;
                    $i++;
                }
            }

            return $data;
        }

    }


    protected function setFilePath($fileName, $storagePath = '..' . DIRECTORY_SEPARATOR . 'tmp')  //:TODO refactoring
    {
        return $storagePath . DIRECTORY_SEPARATOR . $fileName;
    }


}