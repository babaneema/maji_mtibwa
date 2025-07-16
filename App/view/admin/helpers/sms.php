<?php
$sms_balance = 0;
$username=API_KEYS;
$password=SECRET;
$Url=API_URL_BALANCE;

$ch = curl_init($Url);
error_reporting(E_ALL);
ini_set('display_errors', 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt_array($ch, array(
    CURLOPT_HTTPGET => TRUE,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HTTPHEADER => array(
        'Authorization:Basic ' . base64_encode("$username:$password"),
        'Content-Type: application/json'
    ),
));
// Send the request
$response = curl_exec($ch);

if($response === FALSE){
        // echo $response;

    // die(curl_error($ch));
    $sms_balance = 0;
}
$result = json_decode($response, true);
// var_dump($result["data"]["credit_balance"]);
// var_dump($response);
$sms_balance = $result["data"]["credit_balance"];
?>

