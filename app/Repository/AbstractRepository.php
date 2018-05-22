<?php

namespace App\Repository;

use App\Classes\SupplierData\AbstractSupplierData;
use App\Repository\BrandRepository;

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

    protected $brands;


    /**
     * @param $data
     * @return mixed
     */
    abstract public function saveLoadingData($data, $supplierData);

    /**
     * @param $price
     * @param null $brand
     */
    protected function calculatePrice($price, $brand){

    }

    /**
     * AbstractRepository constructor.
     * @param AbstractSupplierData $supplierData
     */
    public function __construct(AbstractSupplierData $supplierData)
    {
        $this->supplierData = $supplierData;
        $this->brands = BrandRepository::getBrandNameList();
    }

    protected function isInBrandList($brand){
        return (! in_array(strtolower($brand), $this->supplierData->brands));
    }
}