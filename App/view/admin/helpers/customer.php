<?php 
header("X-XSS-Protection: 0"); 
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../../../vendor/autoload.php';


$customer = new \App\Model\Customer();
$database = $customer->getDatabase();

$id = isset($_GET['id']) ? $_GET['id'] : header('Location: ../auth/logout.php');
$data = $database->select($customer->table_name, [
    "[>]branch" => ["customer_branch" => "branch_id"]
], [
    "branch_name", "customer_id", "customer_unique", 
    "customer_name", "customer_gender", "customer_contact", "customer_house_number",
    "customer_reg_date", "customer_address"
],
[
    "customer_unique" => $id
]
);

$meter = new \App\Model\Meter();
$database = $meter->getDatabase();
$meterData = $database->select($meter->table_name, [
    "meter_unique", "meter_number", "meter_lock", "meter_intital_unit"
], 
[
    "meter_customer" => $data[0]['customer_id']
]
);



$initial_unit = !empty($meterData[0]['meter_intital_unit']) ? $meterData[0]['meter_intital_unit'] : 0;

if($database->error) header('Location: ../auth/logout.php');

$customer_id = $data[0]['customer_id'];

// get bills
$bill = new \App\Model\Bill();
$database = $bill->getDatabase();

$bdata = $database->query(
    "SELECT bill_reg_date, bill_unit_used, bill_cost, bill_unit,bill_id, bill_unique
    FROM bill 
    WHERE bill_customer=$customer_id"
    )->fetchAll();

$payment = new \App\Model\Payment();
$pdatabase = $payment->getDatabase();

$totalBill = 0;
$totalPaid = 0;



$pdata = $pdatabase->query(
    "SELECT pay_reg_date,pay_amount,pay_unique, bill_cost, bill_unique  FROM payments  
    JOIN bill ON pay_bill=bill_id WHERE pay_customer=$customer_id"
    )->fetchAll();