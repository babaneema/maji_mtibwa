<?php
require_once '../../../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if ($_POST['token'] == $_SESSION['_addMeter_token']) {
    
    // Getform form data
    $unique = htmlentities($_POST['cutomer_unique']);
    $meter_owner = htmlentities($_POST['meter_owner']);
    $meter_number = htmlentities($_POST['meter_number']);
    $initial_units = htmlentities($_POST['initial_units']);
    $joining_fees = htmlentities($_POST['joining_fees']);
    
    $customer = new \App\Model\Customer();
    $database = $customer->getDatabase();

    $data = $database->select($customer->table_name, '*', ['customer_unique' => $unique]);
    $customer_n = $data[0]['customer_id'];
   
    // Save data
    $meter = new \App\Model\Meter(
        customer: $customer_n, owner: $meter_owner, 
        number: $meter_number, initial_unit: $initial_units, joining_price: $joining_fees
    );
    $save = $meter->insert();
   
    if(!$save){
        // Handle Errors
        $_SESSION['error'] = 'Could not add meter!';
        header('Location: ../../view/admin/addMeter.php?id='.$unique);
        exit;
    }
    
    // Return to branch 
    $_SESSION['success'] = 'Meter saved successfuly';
    header('Location: ../../view/admin/customerView.php?id='.$unique);
    unset($_SESSION['_addBrach_token']);
    exit;
}

// form does not have token
session_destroy();
header('Location: ../../view/auth/login.php');
