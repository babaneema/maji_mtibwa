<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) session_start();
// $_POST['token'] == $_SESSION['_addCustomer_token']
if (true) {
    // Getform form data

    $branch_id = htmlentities($_POST['branch_id']);
    $price = htmlentities($_POST['unit_price']);

    // Save data
    $unit = new \App\Model\Unit(branch: $branch_id, price:  $price);
    $save = $unit->insert();
    if(!$save){
        // Handle Errors
        $_SESSION['error'] = 'Could not add Unit.';
        header('Location: ../../view/admin/addUnit.php');
        exit;
    }
    // Return to branch 
    $_SESSION['success'] = 'Unit saved successfuly';
    header('Location: ../../view/admin/unit.php');
    unset($_SESSION['_addCustomer_token']);
    exit;
}

// form does not have token
session_destroy();
header('Location: ../../view/auth/login.php');