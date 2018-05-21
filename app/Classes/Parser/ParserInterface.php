<?php

namespace App\Classes\Parser;

use App\Classes\SupplierData\AbstractSupplierData;

interface ParserInterface
{
    public function parse(AbstractSupplierData $supplierData);
}