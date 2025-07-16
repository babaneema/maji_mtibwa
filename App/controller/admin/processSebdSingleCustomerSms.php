<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../../vendor/autoload.php';
require_once '../../helpers/smss.php';

// get initial data
if (session_status() === PHP_SESSION_NONE) session_start();

if ($_POST['token'] == $_SESSION['_SendSingleCustomerSms_token']) {
    // Getform form data
    // unset($_SESSION['_filterAllPayroll_token']); 
    
    $customer_uuid      = htmlentities($_POST['customer_uuid']);
    $customer_contact   = htmlentities($_POST['customer_contact']);
    $message            = htmlentities($_POST['message']);


    // Get meter, customer and bill information
    sendSingleSms($customer_contact, $message);
    $_SESSION['success'] = 'Customer Message Sent successfuly';
    header('Location: ../../view/admin/customerSendMessage.php?id='.$customer_uuid);
    exit;
}

// form does not have token
session_destroy();
header('Location: ../../view/auth/login.php');
?>