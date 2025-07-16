<?php
require_once '../../../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if ($_POST['token'] == $_SESSION['_addBrach_token']) {
    // Getform form data
    $name = htmlentities($_POST['branch_name']);

    // Save data
    $branch = new \App\Model\Branch('', '', $name);
    $save = $branch->insert();
    if(!$save){
        // Handle Errors
        $_SESSION['error'] = 'Could not add branch. Check if branch name has been used!';
        header('Location: ../../view/admin/addBranch.php');
        exit;
    }
    
    // Return to branch 
    $_SESSION['success'] = 'Branch saved successfuly';
    header('Location: ../../view/admin/branch.php');
    unset($_SESSION['_addBrach_token']);
    exit;
}

// form does not have token
session_destroy();
header('Location: ../../view/auth/login.php');
