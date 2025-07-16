<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../../vendor/autoload.php';
require_once '../../helpers/smss.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if ($_POST['token'] == $_SESSION['_addReadMeter_token']) {
    // Getform form data
    $meter_unique = htmlentities($_POST['meter_id']);
    $reading = htmlentities($_POST['reading']);

    // Get meter, customer and bill information
    $meter = new \App\Model\Meter();
    $database = $meter->getDatabase();

    $data = $database->select($meter->table_name,
        [
            "[><]customer" => ["meter_customer" => "customer_id"],
        ],
        [
            'meter_id', 'meter_unique', 'meter_intital_unit','customer_branch',
            'meter_lock', 'customer_name', 'customer_contact', 'customer_address',
            'customer_id'
        ],
        [
            "meter_unique" => $meter_unique
        ]
    );


    $cust_id = $data[0]['customer_id'];
    $cust_meter_id= $data[0]['meter_id'];
    $cust_branch = $data[0]['customer_branch'];

    $initial_unit = $data[0]['meter_intital_unit'];

    $bdata = $database->query(
        "SELECT bill_reg_date, bill_unit_used, bill_cost, bill_unit,bill_id, bill_unique
        FROM bill 
        WHERE bill_customer=$cust_id"
        )->fetchAll();
    $sum_unit_used = 0;
    foreach ($bdata as $bdt) {
        $initial_unit += $bdt['bill_unit_used'];
    }
    
    $sum_unit_used = $initial_unit;
    $sum_bill_cost = $database->sum('bill', 'bill_cost', ['bill_customer' => $cust_id]);
    $sum_paid_amount = $database->sum('payments', 'pay_amount', ['pay_customer' => $cust_id]);

    // if empty then set to zero 
    empty($sum_unit_used) ? $sum_unit_used = 0 : $sum_unit_used;
    empty($sum_bill_cost) ? $sum_bill_cost = 0 : $sum_bill_cost;
    empty($sum_paid_amount) ? $sum_paid_amount = 0 : $sum_paid_amount;

    
    $unit = $database->max('unit', "unit_price", ["unit_branch" => $cust_branch]);

    $new_unit = (float) $reading - (float) $sum_unit_used;
    $new_bill_cost = $new_unit * (float)$unit;

 


    $past_dept = (float) $sum_bill_cost - (float) $sum_paid_amount;

    $total_b = (float) $new_bill_cost  + $past_dept;

    $massage = ' Umetumia Units :  '.$new_unit.' Kutoka : '.$sum_unit_used.'. Hadi : '.$reading.' Deni lako la nyuma ni Tsh : '.$past_dept.' Jumla ya deni lako ni Tsh :'.$total_b;
    
    $bill = new \App\Model\Bill(customer: $cust_id, meter: $cust_meter_id, unit: 6, used: $new_unit, cost: $new_bill_cost);
    

   
   

    $save = $bill->insert();
    if(!$save){
        // Handle Errors
        $_SESSION['error'] = 'Could not save new bill. Please try again later';
        header('Location: ../../view/tech/readMeter.php?id='.$meter_unique);
        exit;
    }

    $number = $data[0]['customer_contact'];
    sendSingleSms($number, $massage);
    
    // Return to branch 
    $_SESSION['success'] = 'Meter read successfuly';
    header('Location: ../../view/tech/viewSingleMeterStatus.php?id='.$meter_unique);
    unset($_SESSION['_addReadMeter_token']);
    exit;
}

// form does not have token
session_destroy();
header('Location: ../../view/auth/login.php');