<?php 
require_once '../../../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id = isset($_GET['id']) ? $_GET['id'] : header('Location: ../../auth/logout.php');


// Save data
$customer = new \App\Model\Customer();
$database = $customer->getDatabase();

// Get work information
$data = false;
$data = $database->count($customer->table_name);

if($data){
    $database->delete($customer->table_name, ["customer_unique" => $id]);
    $_SESSION['success'] = 'Customer deleted successfuly';
    header('Location: ../../view/admin/customer.php');
    exit;
}


$_SESSION['error'] = 'Could not delete customer';
header('Location: ../../view/admin/customerView.php?id='.$id);
exit;