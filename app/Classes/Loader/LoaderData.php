<?php

namespace App\Classes\Parser;

use App\Classes\Supplier\AbstractSupplierData;

class LoaderData
{

    protected $supplier;

    public function __construct(AbstractSupplierData $supplier)
    {
        $this->supplier = $supplier;
    }

//    public function parseFile()
//    {
//        $data = file_get_contents($this->supplier->url);
//
//        $rows = explode("\n", $data);
//        unset($data);
//
//        $keys = str_getcsv($rows[0], $this->supplier->delimiter);
//
//        $s = array();
//        $counter = 0;
//
//        $header = true; // :TODO for debuging
//        $supplierFkay = 'sku';  // :TODO create
//
//        foreach ($rows as $row) {
//            if ($header) {
//                if ($counter++ == 0) continue;
//                $csv = str_getcsv($row, $this->supplier->delimiter);
//                $min = min(count($keys), count($csv));
//                $product = array_combine(array_slice($keys, 0, $min), array_slice($csv, 0, $min));
//                if (
//                    $min < count($keys) ||
//                    !array_key_exists($supplierFkay, $product) ||
//                    trim($product[$supplierFkay]) == ""
//                ) {
//                    p("CSV Error: Product missing fields", 'hidden', $product);
//                    continue;
//                } else {
//                    $s[$product[$supplierFkay]] = $product;
//                }
//            } else {
//                $product = str_getcsv($row, $this->supplier->delimiter);
//                if (count($product) < count($sup->map)) {  //:TODO check
//                    p("CSV Error: Product missing fields", 'hidden', $product);
//                    continue;
//                } else {
//                    $s[$sup->fkey] = $product;
//                }
//            }
//        }
//        unset($rows);
//        return $s;
//    }

}


//    public function getXML()
//    {
//
//        echo "Getting product data from {$sup->name}<br>";
//
//        if (isset($sup->username)) {
//            echo "Logging in using simple auth.<br>";
//
//            if (isset($sup->secure) && $sup->secure == false) {
//                $context = stream_context_create(array(
//                    "ssl" => array(
//                        "verify_peer" => false,
//                        "verify_peer_name" => false,
//                    ),
//                    'http' => array(
//                        'header' => "Authorization: Basic " . base64_encode("{$sup->username}:{$sup->password}")
//                    )
//                ));
//            } else {
//                $context = stream_context_create(array(
//                    'http' => array(
//                        'header' => "Authorization: Basic " . base64_encode("{$sup->username}:{$sup->password}")
//                    )
//                ));
//            }
//            $data = file_get_contents($sup->url, false, $context);
//        } else {
//            // 	wrapper for local files but not as safe
//            $data = file_get_contents($sup->url);
//        }
//
//
//// read remote file
//
//        /*
//            $ch = curl_init();
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//            curl_setopt($ch, CURLOPT_URL, $sup->url);
//            $data = curl_exec($ch);
//            curl_close($ch);
//        */
//
//        if (!$data) {
//            p("Unable to open remote cvs file.");
//            return;
//        }
//
//
//        $xmlProducts = new SimpleXMLElement($data);
//
//        unset($data);
//
//        $s = array();
//        $counter = 0;
//
////	p($sup->map);
//
//        openHiddenDiv();
//
//        foreach ($xmlProducts->product as $product) {
//            $s[] = (array)$product;
//        }
//        unset($rows);
//        closeHiddenDiv();
//        return $s;
//    }
