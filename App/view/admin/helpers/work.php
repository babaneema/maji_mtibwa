<?php 
header("X-XSS-Protection: 0"); 
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../../../vendor/autoload.php';

$work = new \App\Model\Work();
$database = $work->getDatabase();

$id = isset($_GET['id']) ? $_GET['id'] : header('Location: ../auth/logout.php');

$data = $database->select($work->table_name, "*", ['work_unique' => $id]);
if(!$data)  header('Location: ../auth/logout.php');

$workEquipment = new \App\Model\WorkEquipment();