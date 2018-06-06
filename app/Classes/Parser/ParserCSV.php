<?php

namespace App\Classes\Parser;

use App\Classes\SupplierData\AbstractSupplierData;

class ParserCSV implements ParserInterface
{
    public function parse(AbstractSupplierData $supplierData){

        if ($supplierData->_name == 'supplier3') $this->createHeader($supplierData);  //:TODO refactoring if not have a header

        $filePath = $this->setFilePath($supplierData->fileName);

        $csv = new \ParseCsv\Csv();

        // package not work with '\t'
        if ($supplierData->delimiter == '\t'){
            $csv->delimiter = "\t";
        }
        if ($supplierData->delimiter == ';'){
            $csv->delimiter = ";";
        }
        if ($supplierData->delimiter == ','){
            $csv->delimiter = ",";
        }

        $csv->parse($filePath);


        if ($supplierData->_name != 'supplier3') {  // :TODO

            $arrColumns = $supplierData->dataProducts;
            $columnsList = array_values($arrColumns);

            array_walk($csv->data, function (&$a) use ($columnsList) {
                foreach ($a as $k => $v) {
                    if (!in_array($k, $columnsList)) {
                        unset ($a[$k]);
                    }
                }
            });

            $arrColumns = array_flip($arrColumns);

            array_walk($csv->data, function (&$a) use ($arrColumns) {

                foreach ($a as $k => $v) {
                    if ($arrColumns[$k] !== $k) {
                        $a[$arrColumns[$k]] = $a[$k];
                        unset ($a[$k]);
                    }
                }
            });
        }

        return $csv->data;

    }

    //:TODO rebase in helpers
    protected function setFilePath($fileName, $storagePath = '..' . DIRECTORY_SEPARATOR . 'tmp')
    {
        return storage_path('sync/' . $fileName);
    }


    protected function changeKey($key, $new_key, &$arr, $rewrite = true)
    {
        if (!array_key_exists($new_key, $arr) || $rewrite) {

            if ($new_key !== $key) {
                $arr[$new_key] = $arr[$key];
                unset($arr[$key]);
            }

            return true;
        }
        return false;
    }

    protected function createHeader(AbstractSupplierData $supplierData)
    {
        $filePath = $this->setFilePath($supplierData->fileName);

        $header = implode($supplierData->delimiter, $supplierData->dataProducts);

        file_put_contents($filePath, $header . "\r\n" . file_get_contents($filePath));
    }

}