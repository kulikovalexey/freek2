<?php

namespace App\Classes\Parser;


use App\Classes\Supplier\AbstractSupplierData;

class Parser
{
    public function parse(AbstractSupplierData $supplierData)
    {
        if ($supplierData->fileType == 'csv') {
            return (new ParserCSV())->parse($supplierData);

        } elseif ($supplierData->fileType == 'xml') {

            return (new  ParserXML())->parse($supplierData);

        } else {
            throw new Exception('incorrect file type');
        }

    }
}
