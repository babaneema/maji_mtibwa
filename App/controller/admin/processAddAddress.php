<?php
require_once '../../../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if ($_POST['token'] == $_SESSION['_addAddress_token']) {
    // Getform form data
    $name = htmlentities($_POST['address_name']);
    $branch_id = htmlentities($_POST['branch_id']);

    // Save data
    $address = new \App\Model\Address('','', $branch_id, $name);
    $save = $address->insert();
    if(!$save){
        // Handle Errors
        $_SESSION['error'] = 'Could not add address. Check if address name has been used!';
        header('Location: ../../view/admin/addAddress.php');
        exit;
    }
    // Return to branch 
    $_SESSION['success'] = 'Address saved successfuly';
    header('Location: ../../view/admin/address.php');
    unset($_SESSION['_addAddress_token']);
    exit;
}

// form does not have token
session_destroy();
header('Location: ../../view/auth/login.php');
