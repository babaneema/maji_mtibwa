<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use DateTime;
use DateTimeZone;
$now = new DateTime('now', new DateTimeZone('Africa/Dar_es_Salaam'));

// get initial data
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../../../vendor/autoload.php';


$id = isset($_GET['id']) ? $_GET['id'] : header('Location: ../../view/auth/login.php');

$employee = new \App\Model\Employee();
$database = $employee->getDatabase();

$data = $database->select($employee->table_name, "*", ["employee_unique" => $id]);

$employee_id = $data[0]['employee_id'];
$time_in = $now->format('Y-m-d H:i:s');

$checkin = new \App\Model\Checkin(employee: $employee_id, in: $time_in);
$save = $checkin->insert();
header('Location: ../../view/admin/checkinStatus.php?id='.$id);