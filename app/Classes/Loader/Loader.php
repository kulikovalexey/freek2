<?php

namespace App\Classes\Loader;

use App\Classes\Supplier\AbstractSupplierData;

/**
 * Class Loader for download suppliers files  :TODO check english
 * @package App\Classes\Loader
 */
class Loader
{
    public function downloadFile(AbstractSupplierData $supplier)
    {
        $filePath = $this->setFilePath($supplier->fileName);

        $this->deleteOldFile($filePath);

        $this->sendRequest($supplier->url, $filePath);

        if (file_exists($filePath)){
            return true;
        } else {
            throw new \Exception('File not uploaded');
        }
    }

    protected function setFilePath($fileName, $storagePath = '..'. DIRECTORY_SEPARATOR . 'tmp')  //:TODO refactoring
    {
        return  $storagePath . DIRECTORY_SEPARATOR . $fileName;
    }


    protected function deleteOldFile($filePath)
    {
        unlink($filePath);
    }

    protected function sendRequest($url, $filePath)
    {
        $client = new \GuzzleHttp\Client();
        $client->request(
            'GET',
            $url,
            ['sink' => $filePath]
        );
    }

    //:TODO еще одна попытка
//    public function

}