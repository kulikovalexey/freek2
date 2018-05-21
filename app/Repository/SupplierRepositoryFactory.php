<?php

namespace App\Repository;

use App\Classes\SupplierData\AbstractSupplierData;


class SupplierRepositoryFactory
{

    const SUPPLIER1 = 'supplier1';
    const SUPPLIER2 = 'supplier2';
    const SUPPLIER3 = 'supplier3';
    const SUPPLIER4 = 'supplier4';

    public function makeSupplierRepository(AbstractSupplierData $supplierData)
    {
        switch ($supplierData->_name) {
            case self::SUPPLIER1:
                return new Supplier1Repository($supplierData);

            case self::SUPPLIER2:
                return new Supplier2Repository($supplierData);

            case self::SUPPLIER3:
                return new Supplier3Repository($supplierData);

            case self::SUPPLIER4:
                return new Supplier4Repository($supplierData);

            default:
                return false;
        }

	}
}