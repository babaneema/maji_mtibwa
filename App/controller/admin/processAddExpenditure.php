<?php
require_once '../../../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if ($_POST['token'] == $_SESSION['_addExpenditure_token']) {
    // Getform form data
    $item = htmlentities($_POST['item']);
    $description = htmlentities($_POST['description']);
    $amount = htmlentities($_POST['amount']);
    $item_cost = htmlentities($_POST['item_cost']);
    $supplier = htmlentities($_POST['supplier']);
    $contact = htmlentities($_POST['contact']);
    $authorized = htmlentities($_POST['authorized']);
   
    // Save data
    $expenditure = new \App\Model\Expenditure(
        '','', $item, $description, $item_cost, $amount, '', 
        $authorized, $supplier, $contact
    );
    $save = $expenditure->insert();
    if(!$save){
        // Handle Errors
        $_SESSION['error'] = 'Could not add expenditure. Please try again later';
        header('Location: ../../view/admin/addExpenditure.php');
        exit;
    }
    // Return to branch 
    $_SESSION['success'] = 'Expenditure saved successfuly';
    header('Location: ../../view/admin/expenditure.php');
    unset($_SESSION['_addAddress_token']);
    exit;
}

// form does not have token
session_destroy();
header('Location: ../../view/auth/login.php');
