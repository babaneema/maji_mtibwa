<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if ($_POST['token'] == $_SESSION['_filterPayroll_token']) {
    // unset token
    unset($_SESSION['_filterPayroll_token']);

    // Getform form data
    $employee_id    = htmlentities($_POST['employee_id']); 
    $start_date     = htmlentities($_POST['start_date']);
    $end_date       = htmlentities($_POST['end_date']); 
   

    $_SESSION['payroll_start_date'] = $start_date;
    $_SESSION['payroll_end_date'] = $end_date;

    // Apply filter
    $task = new \App\Model\Task();
    $pdatabase = $task->getDatabase();

    $bill = new \App\Model\Bill();
    $bdatabase  = $bill->getDatabase();

    $payrollData = $pdatabase->select(
        $task->table_name, 
        [
            "[><]employees" => ["task_employee" => "employee_id"],
        ],
        [
            'employee_id', 'employee_name', 'employee_contact', 'task_id', 'task_unique', 
            'task_employee', 'task_item', 'task_amount', 'task_reg_date' 
        ],
        [
            "task_employee" => $employee_id,
            "task_reg_date[<>]" => [$start_date, $end_date]
        ]

    );
    $_SESSION['employee_payrol_data'] = $payrollData;
    header('Location: ../../view/admin/employeeSinglePayrolView.php');
    exit;
}

// form does not have token
session_destroy();
header('Location: ../../view/auth/login.php');
