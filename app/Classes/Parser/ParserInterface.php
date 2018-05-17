<?php

namespace App\Classes\Parser;

use App\Classes\Supplier\AbstractSupplierData;

interface ParserInterface
{
    public function parse(AbstractSupplierData $supplierData);
}