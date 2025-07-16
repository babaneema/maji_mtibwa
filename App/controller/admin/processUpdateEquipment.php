<?php
require_once '../../../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if ($_POST['token'] == $_SESSION['_update_token']) {
    // Getform form data
    $name = htmlentities($_POST['name']);
    $type = htmlentities($_POST['type']);
    $company = htmlentities($_POST['company']);
    $id = htmlentities($_POST['id']);

    // Save data
    $equpment = new \App\Model\Equipment(id: $id ,name: $name, type: $type, company: $company);
    $save = $equpment->update();
    if(!$save){
        // Handle Errors
        $_SESSION['error'] = 'Could not update equipment data!';
        header('Location: ../../view/admin/updateEquipment.php=id=');
        exit;
    }
    
    // Return to branch 
    $_SESSION['success'] = 'Equipment updated successfuly';
    header('Location: ../../view/admin/equipment.php');
    unset($_SESSION['_update_token']);
    exit;
}

// form does not have token
session_destroy();
header('Location: ../../view/auth/login.php');
