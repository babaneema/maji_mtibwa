<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if ($_POST['token'] == $_SESSION['_updateEmployee_token']) {
    // Getform form data unique
    $id             = htmlentities($_POST['id']);
    $unique         = htmlentities($_POST['unique']);
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
        branch: $branch_id, id: $id, name: $name, 
        gender: $gender, contact: $contact, 
        address: $address, department: $department,
        authority: $authority, password: $hashedPassword,
    );
    $save = $customer->update();

    // var_dump($save);
    // die("Kibabe sanaa");

    if(!$save){
        // Handle Errors
        $_SESSION['error'] = 'Could not update Employee.';
        header('Location: ../../view/admin/updateEmployee.php?id='.$unique);
        unset($_SESSION['_updateEmployee_token']);
        exit;
    }
    // Return to branch 
    $_SESSION['success'] = 'Employee updated successfuly';
    header('Location: ../../view/admin/employeeView.php?id='.$unique);
    unset($_SESSION['_updateEmployee_token']);
    exit;
}

// form does not have token
session_destroy();
header('Location: ../../view/auth/login.php');