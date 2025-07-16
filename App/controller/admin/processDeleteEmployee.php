<?php 
require_once '../../../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id = isset($_GET['id']) ? $_GET['id'] : header('Location: ../../auth/logout.php');


// Save data
$employee = new \App\Model\Employee();
$database = $employee->getDatabase();

// Get work information
$data = false;
$data = $database->count($employee->table_name);

if($data){
    $database->delete($employee->table_name, ["employee_unique" => $id]);
    $_SESSION['success'] = 'Employee deleted successfuly';
    header('Location: ../../view/admin/employees.php');
    exit;
}


$_SESSION['error'] = 'Could not delete customer';
header('Location: ../../view/admin/employeeView.php?id='.$id);
exit;