<?php header("X-XSS-Protection: 0"); 
if (session_status() === PHP_SESSION_NONE) session_start();
$_SESSION['_updateEmployee_token'] = bin2hex(random_bytes(32));

require_once '../../../vendor/autoload.php';

$branch = new \App\Model\Branch();
$database = $branch->getDatabase();


$data = [];
$id = isset($_GET['id']) ? $_GET['id'] : header('Location: ../auth/logout.php');

$employee = new \App\Model\Employee();

$data = [];

($employee->selectWhere('employee_unique', $id)) ? 
    $data = $employee->selectWhere('employee_unique', $id) : 
    $_SESSION['error'] = 'Could not get data. Please try again';