<?php 
header("X-XSS-Protection: 0"); 
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../../../vendor/autoload.php';


$employee = new \App\Model\Employee();
$database = $employee->getDatabase();

$id = isset($_GET['id']) ? $_GET['id'] : header('Location: ../auth/logout.php');

$data = $database->select($employee->table_name, [
    "[>]branch" => ["employee_branch" => "branch_id"]
], 
    [
        "branch_name", "employee_id", "employee_unique", 
        "employee_name", "employee_gender", "employee_contact", 
        "employee_address","employee_department", "employee_authority", 
        "employee_password", "employee_reg_date"
    ],
    [
        "employee_unique" => $id
    ]
);