<?php 
require_once '../../../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id = isset($_GET['id']) ? $_GET['id'] : header('Location: ../../auth/logout.php');
$customer = isset($_GET['customer']) ? $_GET['customer'] : header('Location: ../../auth/logout.php');


// Save data
$bill = new \App\Model\Bill();
$database = $bill->getDatabase();

// Get work information
$data = false;
$data = $database->select($bill->table_name, "*", ["bill_unique" => $id]);

if($data){
    $database->delete("bill", ["bill_unique" => $id]);
    $_SESSION['success'] = 'bill deleted successfuly';
    header('Location: ../../view/admin/customerView.php?id='.$customer);
    exit;
}




$_SESSION['error'] = 'Could not delete work';
header('Location: ../../view/admin/customerView.php?id='.$customer);
exit;