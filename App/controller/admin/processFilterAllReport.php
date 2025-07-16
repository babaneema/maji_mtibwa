<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) session_start();

// if ($_POST['token'] == $_SESSION['_filterAllReport_token']) {
if (true) {
    // unset token
    // unset($_SESSION['_filterAllReport_token']);

    // Getform form data
    $street = htmlentities($_POST['street']);
    $report_type = htmlentities($_POST['report_type']);
    $start_date = htmlentities($_POST['start_date']);
    $end_date = htmlentities($_POST['end_date']); 

    $_SESSION['all_report_start_date'] = $start_date;
    $_SESSION['all_report_end_date'] = $end_date;


    // You dont know what you are getting. 
    // let start with customers 
    if($report_type == "Customers"){
        $customer = new \App\Model\Customer();
        $cdatabase = $customer->getDatabase();

        if(empty($street)){
            $mdata =  $cdatabase->select($customer->table_name, 
                [
                    "[>]branch" => ["customer_branch" => "branch_id"]
                ],
                [
                    "branch_name", "customer_unique", 
                    "customer_name", "customer_gender", "customer_contact",
                    "customer_reg_date", "customer_address"
                ],
                [
                    "customer_reg_date[<>]" => [$start_date, $end_date]
                ]
            );
        }else{
            $mdata =  $cdatabase->select($customer->table_name, 
                [
                    "[>]branch" => ["customer_branch" => "branch_id"]
                ],
                [
                    "branch_name", "customer_unique", 
                    "customer_name", "customer_gender", "customer_contact",
                    "customer_reg_date", "customer_address"
                ],
                [
                    "customer_address"      => $street,
                    "customer_reg_date[<>]" => [$start_date, $end_date]
                ]
            );
        }
        

        $_SESSION['all_report_status'] = "Customers";
        $_SESSION['all_report_data'] = $mdata;
        header('Location: ../../view/admin/allReportView.php');
        exit;
    }
    else if($report_type == "Meters"){
        $meter = new \App\Model\Meter();
        $mdatabase = $meter->getDatabase();

        if(empty($street)){
            $mdata =  $mdatabase->select($meter->table_name, 
                [
                    "[><]customer" => ["meter_customer" => "customer_id"],
                ],
                [
                    'meter_id', 'meter_unique', 'meter_reg_date','meter_number',
                    'meter_lock', 'customer_name', 'customer_contact', 'customer_address',
                ],
                [
                    "meter_reg_date[<>]"    => [$start_date, $end_date]
                ]
            );
        }else{
            $mdata =  $mdatabase->select($meter->table_name, 
                [
                    "[><]customer" => ["meter_customer" => "customer_id"],
                ],
                [
                    'meter_id', 'meter_unique', 'meter_reg_date','meter_number',
                    'meter_lock', 'customer_name', 'customer_contact', 'customer_address',
                ],
                [
                    "customer_address"      => $street,
                    "meter_reg_date[<>]"    => [$start_date, $end_date]
                ]
            );
        }

        $_SESSION['all_report_status'] = "Meters";
        $_SESSION['all_report_data'] = $mdata;
        header('Location: ../../view/admin/allReportView.php');
        exit;
    }

    else if($report_type == "Bills"){
        $bill = new \App\Model\Bill();
        $bdatabase  = $bill->getDatabase();

        if(empty($street)){
            $bdata = $bdatabase->query(
                "SELECT 
                    bill.bill_reg_date, bill.bill_unit_used, bill.bill_cost, bill.bill_unit, bill.bill_id, bill.bill_unique,
                    customer.customer_name, customer.customer_contact, customer.customer_address
                FROM bill
                JOIN customer ON customer.customer_id = bill.bill_customer
                WHERE bill.bill_reg_date BETWEEN :start_date AND :end_date",
                [
                    ':start_date' => $start_date,
                    ':end_date' => $end_date
                ]
            )->fetchAll();
        }else{
            $bdata = $bdatabase->query(
                "SELECT 
                    bill.bill_reg_date, bill.bill_unit_used, bill.bill_cost, bill.bill_unit, bill.bill_id, bill.bill_unique,
                    customer.customer_name, customer.customer_contact, customer.customer_address
                FROM bill
                JOIN customer ON customer.customer_id = bill.bill_customer
                WHERE bill.bill_reg_date BETWEEN :start_date AND :end_date  AND customer.customer_address = :street ",
                [
                    ':start_date' => $start_date,
                    ':end_date' => $end_date,
                    ':street' => $street
                ]
            )->fetchAll();
        }
       
        // This is expensive as hell.
        foreach ($bdata as $key => $dt) {
            $total = $bdatabase->sum(
                "payments", 
                "pay_amount", 
                ['pay_bill' => $dt['bill_id']]
            );
            if(empty($total)) $total = 0;
            $bdata[$key]['paid'] = $total;
 
        }
        
        $_SESSION['all_report_status'] = "Bills";
        $_SESSION['all_report_data'] = $bdata;
        header('Location: ../../view/admin/allReportView.php');
        exit;
    }

    else if($report_type == "Payment"){
        $payment = new \App\Model\Payment();
        $database  = $payment->getDatabase();

        if(empty($street)){
            $data = $database->query(
                "SELECT 
                    payments.pay_reg_date, payments.pay_method, payments.pay_type, payments.pay_amount,
                    customer.customer_name, customer.customer_contact, customer.customer_address
                FROM payments
                JOIN customer ON customer.customer_id = payments.pay_customer
                WHERE payments.pay_reg_date BETWEEN :start_date AND :end_date",
                [
                    ':start_date' => $start_date,
                    ':end_date' => $end_date
                ]
            )->fetchAll();
        }else{
            $data = $database->query(
                "SELECT 
                    payments.pay_reg_date, payments.pay_method, payments.pay_type, payments.pay_amount,
                    customer.customer_name, customer.customer_contact, customer.customer_address
                FROM payments
                JOIN customer ON customer.customer_id = payments.pay_customer
                WHERE payments.pay_reg_date BETWEEN :start_date AND :end_date  AND customer.customer_address = :street",
                [
                    ':start_date' => $start_date,
                    ':end_date' => $end_date,
                    ':street' => $street
                ]
            )->fetchAll();
        }

        $_SESSION['all_report_status'] = "Payment";
        $_SESSION['all_report_data'] = $data;
        header('Location: ../../view/admin/allReportView.php');
        exit;
    }

    else if($report_type == "General"){
        $customer = new \App\Model\Customer();
        $database  = $customer->getDatabase();
        
        if(empty($street)){
            $customer_count = $database->query(
                "SELECT 
                    COUNT(*) AS customer_count
                FROM customer
                WHERE customer.customer_reg_date BETWEEN :start_date AND :end_date",
                [
                    ':start_date' => $start_date,
                    ':end_date' => $end_date
                ]
            )->fetch();
    
            $all_meter = $database->query(
                "SELECT 
                    COUNT(*) AS all_meter
                FROM meter "
            )->fetch();
    
            $meter_count = $database->query(
                "SELECT 
                    COUNT(*) AS meter_count
                FROM meter
                WHERE meter.meter_reg_date BETWEEN :start_date AND :end_date",
                [
                    ':start_date' => $start_date,
                    ':end_date' => $end_date
                ]
            )->fetch();
    
            
            $bill_data = $database->query(
                "SELECT 
                    bill.bill_cost
                FROM bill
                WHERE bill.bill_reg_date BETWEEN :start_date AND :end_date",
                [
                    ':start_date' => $start_date,
                    ':end_date' => $end_date
                ]
            )->fetchAll();
            
            $b_count = 0;
            $b_tot = 0;
            foreach($bill_data as $bi){
                ++$b_count;
                $b_tot += $bi['bill_cost'];
            }
    
            
            $pay_data = $database->query(
                "SELECT 
                    payments.pay_amount
                FROM payments
                WHERE payments.pay_reg_date BETWEEN :start_date AND :end_date",
                [
                    ':start_date' => $start_date,
                    ':end_date' => $end_date
                ]
            )->fetchAll();

            $p_tot = 0;
            foreach($pay_data as $pa){
                $p_tot += $pa['pay_amount'];
            }
            
        
            $gdata = array(
                'customers'     => $customer_count["customer_count"],
                'meters'        => $meter_count["meter_count"],
                'meter_read'    => $bill_count["bill_count"],
                'bills_count'   => $b_count,
                'bills'         => $b_tot,
                'payments'      => $p_tot,
                'un_paid_bills' => $b_tot - $p_tot
            );
        }else{
            $customer_count = $database->query(
                "SELECT 
                    COUNT(*) AS customer_count
                FROM customer
                WHERE customer.customer_reg_date BETWEEN :start_date AND :end_date AND customer.customer_address = :street",
                [
                    ':start_date'   => $start_date,
                    ':end_date'     => $end_date,
                    ':street'       => $street
                ]
            )->fetch();
    
            $all_meter = $database->query(
                "SELECT 
                    COUNT(*) AS all_meter
                FROM meter 
                JOIN customer ON customer.customer_id = meter.meter_customer
                WHERE  customer.customer_address = :street",
                [
                    ':street'   => $street
                ]
                
            )->fetch();
    
            $meter_count = $database->query(
                "SELECT 
                    COUNT(*) AS meter_count
                FROM meter
                JOIN customer ON customer.customer_id = meter.meter_customer
                WHERE meter.meter_reg_date BETWEEN :start_date AND :end_date AND customer.customer_address = :street",
                [
                    ':start_date'   => $start_date,
                    ':end_date'     => $end_date,
                    ':street'       => $street
                ]
            )->fetch();
            
            
            $bill_data = $database->query(
                "SELECT 
                    bill.bill_cost
                FROM bill
                JOIN customer ON customer.customer_id = bill.bill_customer
                WHERE bill.bill_reg_date BETWEEN :start_date AND :end_date AND customer.customer_address = :street",
                [
                    ':start_date'   => $start_date,
                    ':end_date'     => $end_date,
                    ':street'       => $street
                ]
            )->fetchAll();
            
            $b_count = 0;
            $b_tot = 0;
            foreach($bill_data as $bi){
                ++$b_count;
                $b_tot += $bi['bill_cost'];
            }
    
            
            $pay_data = $database->query(
                "SELECT 
                    payments.pay_amount
                FROM payments
                JOIN customer ON customer.customer_id = payments.pay_customer
                WHERE payments.pay_reg_date BETWEEN :start_date AND :end_date AND customer.customer_address = :street",
                [
                    ':start_date'   => $start_date,
                    ':end_date'     => $end_date,
                    ':street'       => $street
                ]
            )->fetchAll();

            $p_tot = 0;
            foreach($pay_data as $pa){
                $p_tot += $pa['pay_amount'];
            }
            
        
            $gdata = array(
                'customers'     => $customer_count["customer_count"],
                'meters'        => $meter_count["meter_count"],
                'meter_read'    => $bill_count["bill_count"],
                'bills_count'   => $b_count,
                'bills'         => $b_tot,
                'payments'      => $p_tot,
                'un_paid_bills' => $b_tot - $p_tot
            );
        }

        $_SESSION['all_report_status'] = "General";
        $_SESSION['all_report_data'] = $gdata;
        header('Location: ../../view/admin/allReportView.php');
        exit;
    }
}

// form does not have token
session_destroy();
header('Location: ../../view/auth/login.php');
