<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



require_once '../../../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) session_start();

$id = isset($_GET['id']) ? $_GET['id'] : header('Location: ../../auth/logout.php');
$customer = isset($_GET['customer']) ? $_GET['customer'] : header('Location: ../../auth/logout.php');

$meter = new \App\Model\Meter();
$database = $meter->getDatabase();

$data = $database->select($meter->table_name, "*", ['meter_unique' =>$id ]);


if($database->error) header('Location: ../../auth/logout.php');
$lock = $data[0]['meter_lock'];


($lock == 'No') ? $lock = 'Yes' :  $lock = 'No';


$mt = new \App\Model\Meter(unique: $id, lock: $lock);

$save = $mt->lockMeter();


header('Location: ../../view/admin/customerView.php?id='.$customer);
exit;
