<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if ($_POST['token'] == $_SESSION['_addEmployee_token']) {
    // Getform form data
    $name           = htmlentities($_POST['name']);
    $branch_id      = htmlentities($_POST['branch_id']);
    $gender         = htmlentities($_POST['gender']);
    $contact        = htmlentities($_POST['contact']);
    $address        = htmlentities($_POST['address']);
    $house          = htmlentities($_POST['house']);
    $department     = htmlentities($_POST['department']);
    $authority      = htmlentities($_POST['authority']);
    $password       = htmlentities($_POST['password']);


    // Save data
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $customer = new \App\Model\Employee(
        branch: $branch_id, name: $name, 
        gender: $gender, contact: $contact, 
        address: $address, department: $department,
        authority: $authority, password: $hashedPassword,
    );
    $save = $customer->insert();
    if(!$save){
        // Handle Errors
        $_SESSION['error'] = 'Could not add Employee.';
        header('Location: ../../view/admin/addEmployee.php');
        exit;
    }
    // Return to branch 
    $_SESSION['success'] = 'Employee saved successfuly';
    header('Location: ../../view/admin/employees.php');
    unset($_SESSION['_addEmployee_token']);
    exit;
}

// form does not have token
session_destroy();
header('Location: ../../view/auth/login.php');