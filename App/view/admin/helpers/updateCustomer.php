<?php 
if (session_status() === PHP_SESSION_NONE) session_start();
$_SESSION['_updateCustomer_token'] = bin2hex(random_bytes(32));

require_once '../../../vendor/autoload.php';
$branch = new \App\Model\Branch();
$database = $branch->getDatabase();

$data = [];
$id = isset($_GET['id']) ? $_GET['id'] : header('Location: ../auth/logout.php');

$customer = new \App\Model\Customer();
$database = $customer->getDatabase();

$data = [];

($customer->selectWhere('customer_unique', $id)) ? 
    $data = $customer->selectWhere('customer_unique', $id) : 
    $_SESSION['error'] = 'Could not get data. Please try again';

