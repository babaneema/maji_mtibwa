<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../../vendor/autoload.php';
require_once '../../helpers/smss.php';

if (session_status() === PHP_SESSION_NONE) session_start();

if ($_POST['token'] == $_SESSION['_payBill_token']) {
    // Getform form data
    $id = htmlentities($_POST['unique']);
    $amount = htmlentities($_POST['amount']);
    $method = htmlentities($_POST['method']);
    $type = "bill";

    $customerBill = new \App\Model\Bill();
    $database = $customerBill->getDatabase();
    $customerBillData =  $database->select($customerBill->table_name, 
    "*", ['bill_unique' => $id]);
    $cust_dept = $customerBillData[0]['bill_cost'];

    $total = 0;
    $total_bill = 0;
    $total_fine = 0;
    $total_depts = 0;

    // customer Personal Data
    $customer = new \App\Model\Customer();
    $customerPData = $database->select($customer->table_name, 
    "*", ['customer_id' => $customerBillData[0]['bill_customer']] );

    $data = array(
        'pay_bill' =>  $customerBillData[0]['bill_id'],
        'pay_customer' =>  $customerBillData[0]['bill_customer'],
        'pay_method' =>  $method,
        'pay_type' =>  $type,
        'pay_amount' =>  $amount,
    );
    

    $payment = new \App\Model\Payment(
        '', '', $customerBillData[0]['bill_id'],
        $customerBillData[0]['bill_customer'], $method,
        $method, $amount, ''
    );
    
    // get past dept
    $allbills = $database->select($customerBill->table_name, 
    "*", ['bill_customer' => $customerBillData[0]['bill_customer']] );

    $total_p = 0;
    $bill_cost = 0;

    foreach ($allbills as $key => $billed) {
        $bill_cost += $billed['bill_cost'];
        
        // now get paid bill
        $payData = $database->select($payment->table_name,  "*", 
            ['pay_bill' => $billed['bill_id']] );
        
        foreach ($payData as $pdt) {
        $total_p += (int) $pdt['pay_amount'];
        }
    
    }

    
    if($total_p ==  $bill_cost){
        $total_depts=0;
    }
    else{
        $total_depts += ((double) $bill_cost - (double) $total_p) ;
    }

    

    $save = $payment->insert();
    if(!$save){
        // Handle Errors
        $_SESSION['error'] = 'Could not process payment. Please try again!';
        header('Location: ../../view/admin/payBill.php?id='.$id);
        exit;
    }
    
    // Send SmS then return to customer
    $massage = 'Umefanya malipo ya shiling : '.$amount.' Deni ni '.$total_depts - $amount.' Asante';
    $number = $customerPData[0]['customer_contact'];
    sendSingleSms($number, $massage);
    
        
    $_SESSION['success'] = 'Bill paid successfuly';
    header('Location: ../../view/admin/customerView.php?id='.$customerPData[0]['customer_unique']);
    unset($_SESSION['_payBill_token']);
    exit;
}

// form does not have token
session_destroy();
header('Location: ../../view/auth/login.php');
