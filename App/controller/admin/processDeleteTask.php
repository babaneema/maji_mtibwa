<?php 
require_once '../../../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id = isset($_GET['id']) ? $_GET['id'] : header('Location: ../../auth/logout.php');


// Save data
$task = new \App\Model\Task();
$database = $task->getDatabase();

// Get work information
$database->delete($task->table_name, ["task_unique" => $id]);
$_SESSION['success'] = 'Task deleted successfuly';
header('Location: ../../view/admin/tasks.php');
exit;