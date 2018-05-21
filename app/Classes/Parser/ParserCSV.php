<?php

namespace App\Classes\Parser;

use App\Classes\SupplierData\AbstractSupplierData;

class ParserCSV implements ParserInterface
{
    public function parse(AbstractSupplierData $supplierData){

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
        $arrColumns = $supplierData->dataProducts;
        $columnsList = array_values($arrColumns);

        array_walk($csv->data, function (&$a) use ($columnsList) {
            foreach ($a as $k => $v){
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

        return $csv->data;

    }

    protected function setFilePath($fileName, $storagePath = '..'. DIRECTORY_SEPARATOR . 'tmp')  //:TODO refactoring
    {
        return  $storagePath . DIRECTORY_SEPARATOR . $fileName;
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

}