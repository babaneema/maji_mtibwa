<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if ($_POST['token'] == $_SESSION['_addTask_token']) {
    // Getform form data
    $task_employee  = htmlentities($_POST['task_employee']);
    $task_item      = htmlentities($_POST['task_item']);
    $task_amount    = htmlentities($_POST['task_amount']);


    // Save data
    $task = new \App\Model\Task(
        employee: $task_employee, item: $task_item, amount: $task_amount,
    );
    $save = $task->insert();
    if(!$save){
        // Handle Errors
        $_SESSION['error'] = 'Could not add Task.';
        header('Location: ../../view/admin/addTask.php');
        exit;
    }
    // Return to branch 
    $_SESSION['success'] = 'Task saved successfuly';
    header('Location: ../../view/admin/tasks.php');
    unset($_SESSION['_addTask_token']);
    exit;
}

// form does not have token
session_destroy();
header('Location: ../../view/auth/login.php');