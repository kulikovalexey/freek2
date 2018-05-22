<?php

namespace App\Classes\SupplierData;

abstract class AbstractSupplierData
{
    public $id;
    public $url;
    public $name;
    public $fileName;
    public $fileType;
    public $delimiter;

    public $dataProducts;
    public $brands;

    public function __construct($params)
    {
        $this->_name = $params['_name'];
        $this->id = $params['id'];
        $this->name = $params['name'];
        $this->url = $params['url'];
        $this->fileName = $params['fileName'];
        $this->fileType = $params['fileType'];
        $this->delimiter = $params['delimiter'];

        $this->dataProducts = $params['dataProducts'];
        $this->brands = $params['brands'];
    }


}