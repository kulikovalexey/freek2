<?php

namespace App\Classes\Loader;

use App\Classes\SupplierData\AbstractSupplierData;

/**
 * Class Loader for download suppliers files  :TODO check english
 * @package App\Classes\Loader
 */
class Loader
{
    public function downloadFile(AbstractSupplierData $supplier)
    {
        $filePath = $this->setFilePath($supplier->fileName);

        if (file_exists($filePath)) $this->deleteOldFile($filePath);

        $this->sendRequest($supplier->url, $filePath);

        if (file_exists($filePath)) {
            return true;
        } else {
            throw new \Exception('File not uploaded');
        }
    }

    //:TODO rebase in helpers
    protected function setFilePath($fileName, $storagePath = '..' . DIRECTORY_SEPARATOR . 'tmp')
    {
        return storage_path('sync/' . $fileName);
    }


    protected function deleteOldFile($filePath)
    {
        unlink($filePath);
    }

    protected function sendRequest($url, $filePath)
    {
        $client = new \GuzzleHttp\Client([
            'curl' => [
                CURLOPT_CAINFO => base_path('resources/assets/cacert.pem')
            ]
        ]);
        $client->request(
            'GET',
            $url,
            ['sink' => $filePath]
        );
    }
}