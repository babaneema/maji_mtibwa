<?php
require_once '../../../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if ($_POST['token'] == $_SESSION['_addEquipment_token']) {
    // Getform form data
    $name = htmlentities($_POST['name']);
    $type = htmlentities($_POST['type']);
    $company = htmlentities($_POST['company']);

    // Save data
    $equpment = new \App\Model\Equipment(name: $name, type: $type, company: $company);
    $save = $equpment->insert();
    if(!$save){
        // Handle Errors
        $_SESSION['error'] = 'Could not add Equipment. Check if equipment name has been used!';
        header('Location: ../../view/admin/addEquipment.php');
        exit;
    }
    
    // Return to branch 
    $_SESSION['success'] = 'Equipment saved successfuly';
    header('Location: ../../view/admin/equipment.php');
    unset($_SESSION['_addEquipment_token']);
    exit;
}

// form does not have token
session_destroy();
header('Location: ../../view/auth/login.php');
