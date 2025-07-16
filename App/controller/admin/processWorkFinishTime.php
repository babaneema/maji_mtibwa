<?php 
require_once '../../../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id = isset($_GET['id']) ? $_GET['id'] : header('Location: ../../auth/logout.php');
use DateTime;
use DateTimeZone;
$now = new DateTime('now', new DateTimeZone('Africa/Dar_es_Salaam'));

// Save data
$work = new \App\Model\Work(
    unique: $id,
    finish_time: $now->format('Y-m-d H:i:s')
);
$update = $work->finishTime();
$_SESSION['success'] = 'Work finished';
header('Location: ../../view/admin/workView.php?id='.$id);
exit;