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

$data1 = $database->select('checkin', "*", ['checkin_unique' => $id ]);

$employee_id = $data1[0]['checkin_employee'];

$data2 = $database->select('employees', "*", ['employee_id' => $employee_id ]);


$time_out = $now->format('Y-m-d H:i:s');

$customer_id = $data2[0]['employee_unique'];

$checkin = new \App\Model\Checkin(unique: $id, out: $time_out);
$save = $checkin->checkout();
header('Location: ../../view/admin/checkinStatus.php?id='.$customer_id);