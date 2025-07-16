<?php
require_once '../../../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if ($_POST['token'] == $_SESSION['_update_token']) {
    // Getform form data
    $id = htmlentities($_POST['address_id']);
    $name = htmlentities($_POST['address_name']);
    $branch_id = htmlentities($_POST['branch_id']);

    // Save data
    $address = new \App\Model\Address($id,'', $branch_id, $name);
    $save = $address->update();
    if(!$save){
        // Handle Errors
        $_SESSION['error'] = 'Could not add address.';
        header('Location: ../../view/admin/./updateAddress.php?id='.$id);
        exit;
    }
    // Return to branch 
    $_SESSION['success'] = 'Address updated successfuly';
    header('Location: ../../view/admin/address.php');
    unset($_SESSION['_update_token']);
    exit;
}

// form does not have token
session_destroy();
header('Location: ../../view/auth/login.php');
