<?php
require_once '../../../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if ($_POST['token'] == $_SESSION['_update_token']) {
    // Getform form data
    $id = htmlentities($_POST['id']);
    $name = htmlentities($_POST['branch_name']);


    // Save data
    $branch = new \App\Model\Branch($id, '', $name);
    $save = $branch->update();
    if(!$save){
       
        $_SESSION['error'] = 'Could not update branch.';
        header('Location: ../../view/admin/updateBranch.php?id='.$id);
        exit;
    }
    
    // Return to branch 
    $_SESSION['success'] = 'Branch updated successfuly';
    header('Location: ../../view/admin/branch.php');
    unset($_SESSION['_update_token']);
    exit;
}

// form does not have token
session_destroy();
header('Location: ../../view/auth/login.php');
