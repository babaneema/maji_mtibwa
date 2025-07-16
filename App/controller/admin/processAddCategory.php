<?php
require_once '../../../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if ($_POST['token'] == $_SESSION['_addCategory_token']) {
    // Getform form data
    $name = htmlentities($_POST['category_name']);

    // Save data
    $category = new \App\Model\Category('', '', $name);
    $save = $category->insert();
    if(!$save){
        // Handle Errors
        $_SESSION['error'] = 'Could not add category. Check if category name has been used!';
        header('Location: ../../view/admin/addCategory.php');
        exit;
    }
    
    // Return to branch 
    $_SESSION['success'] = 'Category saved successfuly';
    header('Location: ../../view/admin/inventoryCategory.php');
    unset($_SESSION['_addCategory_token']);
    exit;
}

// form does not have token
session_destroy();
header('Location: ../../view/auth/login.php');
