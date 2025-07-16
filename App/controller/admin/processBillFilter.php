<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if ($_POST['token'] == $_SESSION['_billMeter_token']) {
    // unset token
    unset($_SESSION['_filterMeter_token']);

    // Getform form data
    $billStatus = htmlentities($_POST['bill']);
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
   
    if($billStatus == 'paid'){
        $readData = $bdatabase->select(
            $bill->table_name, 
            [
                "[><]customer" => ["bill_customer" => "customer_id"],
                "[><]payments" => ["bill_id" => "pay_bill"],
            ],
            [
                'customer_name', 'customer_contact', 'customer_address', 'bill_unit_used', 'bill_id',
                'bill_reg_date', 'pay_amount', 'bill_cost', 'pay_reg_date'
            ],
            [
                "bill_reg_date[<>]" => [$start_date, $end_date]
            ],
    
        );
    
        foreach ($readData as $key => $dt) {
            $dtt = $bdatabase->select(
                "payments",["pay_id"], 
                [
                    "pay_bill" => $dt['bill_id'],
                ],
            );
            if(empty($dtt)){
               unset($readData[$key]); 
            }
        }
       
        $_SESSION['bill_status'] = $billStatus;
        $_SESSION['bill_data'] = $readData;
        header('Location: ../../view/admin/billStatus.php');
        exit;

    }else{
        $readData = $bdatabase->select(
            $bill->table_name, 
            [
                "[><]customer" => ["bill_customer" => "customer_id"],
            ],
            [
                'customer_name', 'customer_contact', 'customer_address', 'bill_unit_used', 'bill_id',
                'bill_cost',
            ],
            [
                "bill_reg_date[<>]" => [$start_date, $end_date]
            ],

        );

        foreach ($readData as $key => $dt) {
            $dtt = $bdatabase->select(
                "payments",["pay_bill"], 
                [
                    "pay_bill" => $dt['bill_id'],
                ],
            );
            if(!empty($dtt)){
               unset($readData[$key]); 
            }
        } 
    
        $_SESSION['bill_status'] = $billStatus;
        $_SESSION['bill_data'] = $readData;
        header('Location: ../../view/admin/billUnpaid.php');
        exit;
    }
    die('Here12');
    exit;
}

// form does not have token
session_destroy();
header('Location: ../../view/auth/login.php');

// [
//     "[><]customer" => ["pay_customer" => "customer_id"],
// ],
// [
//   'customer_name', 'customer_contact', 'customer_address',
// ]
