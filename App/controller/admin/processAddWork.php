<?php
require_once '../../../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use DateTime;
use DateTimeZone;
$now = new DateTime('now', new DateTimeZone('Africa/Dar_es_Salaam'));

if ($_POST['token'] == $_SESSION['_addWork_token']) {
    // Getform form data
    $name = htmlentities($_POST['name']);
    $description = htmlentities($_POST['description']);
    $location = htmlentities($_POST['location']);
    $technicians = $_POST['technicians'];
    $technicians = implode(", ", $technicians);
    

    // Save data
    $work = new \App\Model\Work(
        title: $name, description: $description, location: $location,
        technicians: $technicians, start_time: $now->format('Y-m-d H:i:s')
    );
    $save = $work->insert();
    if(!$save){
        // Handle Errors
        $_SESSION['error'] = 'Could not add work!';
        header('Location: ../../view/admin/addWork.php');
        exit;
    }
    
    // Return to branch 
    $_SESSION['success'] = 'Work saved successfuly';
    header('Location: ../../view/admin/repair_work.php');
    unset($_SESSION['_addWork_token']);
    exit;
}

// form does not have token
session_destroy();
header('Location: ../../view/auth/login.php');