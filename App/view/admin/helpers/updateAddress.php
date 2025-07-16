<?php 
header("X-XSS-Protection: 0"); 
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../../../vendor/autoload.php';
$_SESSION['_update_token'] = bin2hex(random_bytes(32));

$branch = new \App\Model\Branch();
$database = $branch->getDatabase();


$address = new \App\Model\Address();
$data = [];
$id = isset($_GET['id']) ? $_GET['id'] : header('Location: ../auth/logout.php');
($address->selectWhere('address_unique', $id)) ? 
    $data = $address->selectWhere('address_unique', $id) : 
    $_SESSION['error'] = 'Could not get data. Please try again';
