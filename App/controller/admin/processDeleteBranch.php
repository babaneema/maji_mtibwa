<?php
require_once '../../../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if ($_POST['token'] == $_SESSION['_update_token']) {
    // Getform form data
    $id = htmlentities($_POST['id']);
  
    // Save data
    $branch = new \App\Model\Branch($id);
    $save = $branch->delete();
    if(!$save){
        $_SESSION['error'] = 'Could not delete branch. Check if branch is not used by system';
        header('Location: ../../view/admin/deleteBranch.php?id='.$id);
        exit;
    }
    
    // Return to branch 
    $_SESSION['success'] = 'Branch deleted successfuly';
    header('Location: ../../view/admin/branch.php');
    unset($_SESSION['_update_token']);
    exit;
}

// form does not have token
session_destroy();
header('Location: ../../view/auth/login.php');
