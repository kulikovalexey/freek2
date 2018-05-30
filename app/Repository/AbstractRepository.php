<?php

namespace App\Repository;

use App\Classes\SupplierData\AbstractSupplierData;
use App\Repository\BrandRepository;
use App\SupplierProduct;

abstract class AbstractRepository
{
    /**
     * @var AbstractSupplierData
     */
    protected $supplierData;

    /**
     * @var
     */
    protected $supplierProducts;


    /**
     * @param $data
     * @return mixed
     */
    abstract public function saveLoadingData($data, $supplierData);

    /**
     * @param $price
     * @param null $brand
     * @param null $yourPriceExVatEur
     */
    abstract protected function calculatePrice($price, $brand, $yourPriceExVatEur);

    /**
     * AbstractRepository constructor.
     * @param AbstractSupplierData $supplierData
     */
    public function __construct(AbstractSupplierData $supplierData)
    {
        $this->supplierData = $supplierData;
    }

    protected function isInBrandList($brand){
        return (! in_array(strtolower($brand), $this->supplierData->brands));
    }

    protected function removeOldData($supplierData)
    {
        // remove old data
        $oldData = SupplierProduct::where('supplier_id', $supplierData->id)->first();

        if (isset($oldData->id)) {
            SupplierProduct::where('supplier_id', $supplierData->id)->delete();
        }
    }


    protected function generator($data)
    {
        foreach ($data as $item) {
            yield $item;
        }
    }

    protected function roundPriceDown($price)
    {
        return floor($price);
    }
}