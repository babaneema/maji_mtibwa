<?php
require_once '../../env.php';  

function sendSingleSms($nunber, $massage){
    $api_key=API_KEYS;
    $secret_key=SECRET;

    $namba = array('recipient_id' => '1','dest_addr'=>$nunber);
    
    $postData = array(
        'source_addr' => '',
        'encoding'=>0,
        'schedule_time' => '',
        'message' => $massage,
        'recipients' => [$namba]
    );

    $Url=API_URL;

    $ch = curl_init($Url);
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt_array($ch, array(
        CURLOPT_POST => TRUE,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_HTTPHEADER => array(
            'Authorization:Basic ' . base64_encode("$api_key:$secret_key"),
            'Content-Type: application/json'
        ),
        CURLOPT_POSTFIELDS => json_encode($postData)
    ));

    $response = curl_exec($ch);

    if($response === FALSE){
            echo $response;

        die(curl_error($ch));
    }
    var_dump($response);
}


function sendManySms($nunber, $massage){
    $api_key=API_KEYS;
    $secret_key=SECRET;

    $postData = array(
        'source_addr' => '',
        'encoding'=>0,
        'schedule_time' => '',
        'message' => $massage,
        'recipients' => $nunber
    );

    $Url=API_URL;

    $ch = curl_init($Url);
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt_array($ch, array(
        CURLOPT_POST => TRUE,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_HTTPHEADER => array(
            'Authorization:Basic ' . base64_encode("$api_key:$secret_key"),
            'Content-Type: application/json'
        ),
        CURLOPT_POSTFIELDS => json_encode($postData)
    ));

    $response = curl_exec($ch);

    if($response === FALSE){
            echo $response;

        die(curl_error($ch));
    }
    var_dump($response);
}