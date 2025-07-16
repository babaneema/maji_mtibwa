<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if ($_POST['token'] == $_SESSION['_filterAllPayroll_token']) {
    // unset token
    unset($_SESSION['_filterAllPayroll_token']);

    // Getform form data
    $start_date     = htmlentities($_POST['start_date']);
    $end_date       = htmlentities($_POST['end_date']); 
   

    $_SESSION['payroll_all_start_date'] = $start_date;
    $_SESSION['payroll_all_end_date'] = $end_date;

    // Apply filter
    $task = new \App\Model\Task();
    $pdatabase = $task->getDatabase();

    $employee = new \App\Model\Employee();
    $mdatabase = $employee->getDatabase();

    $payrollData = [];
    $emdata = $mdatabase->select($employee->table_name, "*");
    foreach($emdata as $data){
        $paid =  $pdatabase->sum(
            $task->table_name, "task_amount", [
                "task_employee" => $data['employee_id'],
                "task_reg_date[<>]" => [$start_date, $end_date]
            ] 
        );
        $payrollData[] = [
            'employee_name'     => $data['employee_name'],
            'employee_contact'  => $data['employee_contact'],
            'amount'            => $paid
        ];        
    }

    $_SESSION['employee_payrol_all_data'] = $payrollData;
    header('Location: ../../view/admin/employeePayrolView.php');
    exit;
}

// form does not have token
session_destroy();
header('Location: ../../view/auth/login.php');
