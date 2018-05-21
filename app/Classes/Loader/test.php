<?php

function getCSV($sup) {

    echo "Getting product data from {$sup->name}<br>";

    if (isset($sup->username)) {
        echo "Logging in using simple auth.<br>";

        if (isset($sup->secure) && $sup->secure == false) {
            $context = stream_context_create(array(
                "ssl"=>array(
                    "verify_peer"=>false,
                    "verify_peer_name"=>false,
                ),
                'http' => array(
                    'header'  => "Authorization: Basic " . base64_encode("{$sup->username}:{$sup->password}")
                )
            ));
        }
        else {
            $context = stream_context_create(array(
                'http' => array(
                    'header'  => "Authorization: Basic " . base64_encode("{$sup->username}:{$sup->password}")
                )
            ));
        }
        $data = file_get_contents($sup->url, false, $context);
    }
    else {
        // 	wrapper for local files but not as safe
        $data = file_get_contents($sup->url);
    }

    if (!$data) {
        p("Unable to open remote cvs file.");
        return;
    }

    $rows = explode("\n",$data);
    unset($data);

    if ($sup->header) {
        $keys = str_getcsv($rows[0], $sup->delimiter);
//		p($keys);

        // take away header row
//		$rows = array_shift($rows);
    }

    $s = array();
    $counter = 0;

//	p($sup->map);

    openHiddenDiv();
    foreach($rows as $row) {
        if ($sup->header) {
            if ($counter++ == 0) continue;
            $csv = str_getcsv($row, $sup->delimiter);
            $min = min(count($keys), count($csv));
            $product = array_combine(array_slice($keys, 0, $min), array_slice($csv, 0, $min));
            if($min<count($keys) || !array_key_exists($sup->fkey, $product) || trim($product[$sup->fkey]) == "") {
                p("CSV Error: Product missing fields", 'hidden', $product);
                continue;
            }
            else {
                $s[$product[$sup->fkey]] = $product;
            }
        }
        else {
            $product = str_getcsv($row, $sup->delimiter);
            if (count($product) < count($sup->map)) {
                p("CSV Error: Product missing fields", 'hidden', $product);
                continue;
            }
            else {
                $s[$sup->fkey] = $product;
            }
        }
    }
    unset($rows);
    closeHiddenDiv();
    return $s;
}


function getXML($sup) {

    echo "Getting product data from {$sup->name}<br>";

    if (isset($sup->username)) {
        echo "Logging in using simple auth.<br>";

        if (isset($sup->secure) && $sup->secure == false) {
            $context = stream_context_create(array(
                "ssl"=>array(
                    "verify_peer"=>false,
                    "verify_peer_name"=>false,
                ),
                'http' => array(
                    'header'  => "Authorization: Basic " . base64_encode("{$sup->username}:{$sup->password}")
                )
            ));
        }
        else {
            $context = stream_context_create(array(
                'http' => array(
                    'header'  => "Authorization: Basic " . base64_encode("{$sup->username}:{$sup->password}")
                )
            ));
        }
        $data = file_get_contents($sup->url, false, $context);
    }
    else {
        // 	wrapper for local files but not as safe
        $data = file_get_contents($sup->url);
    }


// read remote file

    /*
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $sup->url);
        $data = curl_exec($ch);
        curl_close($ch);
    */

    if (!$data) {
        p("Unable to open remote cvs file.");
        return;
    }


    $xmlProducts = new SimpleXMLElement($data);

    unset($data);

    $s = array();
    $counter = 0;

//	p($sup->map);

    openHiddenDiv();

    foreach ($xmlProducts->product as $product) {
        $s[] = (array) $product;
    }
    unset($rows);
    closeHiddenDiv();
    return $s;
}

