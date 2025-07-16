<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../../vendor/autoload.php';
require_once '../../helpers/smss.php';

// get initial data
if (session_status() === PHP_SESSION_NONE) session_start();

$totalPayee = 0;
$i = 0;
$start_date = $_SESSION['payroll_start_date'];
$end_date = $_SESSION['payroll_end_date'];
$pdata = $_SESSION['employee_payrol_data'];

foreach($pdata as $data){
    ++$i;
    $totalPayee += $data['task_amount'];
}


$massage = 'Umekulipa Tsh : '.$totalPayee.' kwa kazi toka tar  ni '.$start_date.' Hadi '.$end_date.' Asante';
$number = $pdata[0]['employee_contact'];
sendSingleSms($number, $massage);
$_SESSION['success'] = 'Payroll Message Sent successfuly';
header('Location: ../../view/admin/employeeSinglePayrolView.php');
?>