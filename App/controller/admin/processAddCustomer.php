<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if ($_POST['token'] == $_SESSION['_addCustomer_token']) {
    // Getform form data
    $name = htmlentities($_POST['name']);
    $branch_id = htmlentities($_POST['branch_id']);
    $gender = htmlentities($_POST['gender']);
    $contact = htmlentities($_POST['contact']);
    $address = htmlentities($_POST['address']);
    $house = htmlentities($_POST['house']);

    // Save data
    $customer = new \App\Model\Customer(branch: $branch_id, name: $name, gender: $gender, contact: $contact, house: $house, address: $address);
    $save = $customer->insert();
    if(!$save){
        // Handle Errors
        $_SESSION['error'] = 'Could not add Customer. Check if customer name has been used!';
        header('Location: ../../view/admin/addCustomer.php');
        exit;
    }
    // Return to branch 
    $_SESSION['success'] = 'Customer saved successfuly';
    header('Location: ../../view/admin/customer.php');
    unset($_SESSION['_addCustomer_token']);
    exit;
}

// form does not have token
session_destroy();
header('Location: ../../view/auth/login.php');