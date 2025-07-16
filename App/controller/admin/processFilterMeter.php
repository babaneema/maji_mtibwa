<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if ($_POST['token'] == $_SESSION['_filterMeter_token']) {
    // unset token
    unset($_SESSION['_filterMeter_token']);

    // Getform form data
    $meterStatus = htmlentities($_POST['meter']);
    $start_date = htmlentities($_POST['start_date']);
    $end_date = htmlentities($_POST['end_date']); 

    $_SESSION['start_date'] = $start_date;
    $_SESSION['end_date'] = $end_date;

    // Apply filter
    $meter = new \App\Model\Meter();
    $mdatabase = $meter->getDatabase();

    $bill = new \App\Model\Bill();
    $bdatabase  = $bill->getDatabase();
    // This uses bills to to find out unreaded meter
    // On consideration is meter must not be locked or in service
    $readData = $mdatabase->select(
        $meter->table_name, 
        [
            "[><]customer" => ["meter_customer" => "customer_id"],
        ],
        [
            'meter_id', 'meter_unique', 
            'meter_lock', 'customer_name', 'customer_contact', 'customer_address',
        ],
        [
            "meter_lock" => 'No'
        ]

    );

    if($meterStatus == 'unread'){
        
        foreach ($readData as $key => $dt) {
            $dtt = $bdatabase->select(
                "bill",["bill_id"], 
                [
                    "bill_meter" => $dt['meter_id'],
                    "bill_reg_date[<>]" => [$start_date, $end_date]
                ],
            );
            if(!empty($dtt)){
               unset($readData[$key]); 
            }
        }
        $_SESSION['meter_status'] = $meterStatus;
        $_SESSION['meter_data'] = $readData;
        header('Location: ../../view/admin/meterReadStatus.php');
        exit;
    }else{
        foreach ($readData as $key => $dt) {
            $dtt = $bdatabase->select(
                "bill",["bill_id"], 
                [
                    "bill_meter" => $dt['meter_id'],
                    "bill_reg_date[<>]" => [$start_date, $end_date]
                ],
            );
            if(empty($dtt)){
               unset($readData[$key]); 
            }
        }
        $_SESSION['meter_status'] = $meterStatus;
        $_SESSION['meter_data'] = $readData;
        header('Location: ../../view/admin/meterReadStatus.php');
        exit;
    }
    exit;
}

// form does not have token
session_destroy();
header('Location: ../../view/auth/login.php');
