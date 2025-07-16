<?php 
require_once '../../../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id = isset($_GET['id']) ? $_GET['id'] : header('Location: ../../auth/logout.php');


// Save data
$work = new \App\Model\Work();
$database = $work->getDatabase();

// Get work information
$data = $database->select($work->table_name, "*", ["work_unique" => $id]);

$work_id = $data[0]['work_id'];

// Delete equipement
$database->delete("work_equiment", ["work_equiment_work" => $work_id]);

// delete work
$database->delete($work->table_name, ["work_id" => $work_id]);


$_SESSION['success'] = 'Work deleted successfuly';
header('Location: ../../view/admin/repair_work.php');
exit;