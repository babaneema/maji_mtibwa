<?php 
require_once '../../../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id = isset($_GET['id']) ? $_GET['id'] : header('Location: ../../auth/logout.php');
$customer = isset($_GET['customer']) ? $_GET['customer'] : header('Location: ../../auth/logout.php');


// Save data
$payment = new \App\Model\Payment();
$database = $payment->getDatabase();

// Get work information
$data = false;
$data = $database->select($payment->table_name, "*", ["pay_unique" => $id]);

if($data){
    $database->delete($payment->table_name, ["pay_unique" => $id]);
    $_SESSION['success'] = 'Payment deleted successfuly';
    header('Location: ../../view/admin/customerView.php?id='.$customer);
    exit;
}


$_SESSION['error'] = 'Could not delete payment';
header('Location: ../../view/admin/customerView.php?id='.$customer);
exit;