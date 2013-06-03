<?php

/**
 * Appel des fichiers _liste_* sur misterassur.com par cURL
 * @param $_POST["service"] le fichier à appeler (insee, vsp, ...) 
 */

switch ($_POST["service"]) {
    case 'insee':
        $url = "http://www.misterassur.com/inc/_liste_ville.php";
        $postArray = array("code_postal" => $_POST["zip_code"]);
        break;

    case 'vsp':
        $url = "http://www.misterassur.com/inc/_liste_vehicule_vsp.php";
        $postArray = array(
            "show" => $_POST["show"], 
            "marque" => $_POST["marque"], 
            "modele" => $_POST["modele"],
            "energie" => $_POST["energie"],
            "version" => $_POST["version"]
        );
        break;
}

if ($_POST["service"] == "insee") {
    echo json_encode(simplexml_load_string(curl_post($url, $postArray)));
} else {
    echo curl_post($url, $postArray);
}

/** 
 * Send a POST requst using cURL 
 * @param string $url to request 
 * @param array $post values to send 
 * @param array $options for cURL 
 * @return string 
 */ 
function curl_post($url, array $post = NULL, array $options = array()) { 
    $defaults = array( 
        CURLOPT_POST => 1, 
        CURLOPT_HEADER => 0, 
        CURLOPT_URL => $url, 
        CURLOPT_FRESH_CONNECT => 1, 
        CURLOPT_RETURNTRANSFER => 1, 
        CURLOPT_FORBID_REUSE => 1, 
        CURLOPT_TIMEOUT => 4, 
        CURLOPT_POSTFIELDS => http_build_query($post) 
    ); 

    $ch = curl_init(); 
    curl_setopt_array($ch, ($options + $defaults)); 
    if( ! $result = curl_exec($ch)) 
    { 
        trigger_error(curl_error($ch)); 
    } 
    curl_close($ch); 
    return $result; 
}