<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../../vendor/autoload.php';
require_once '../../helpers/smss.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if (true) {
    // Getform form data
    $branch_id = htmlentities($_POST['branch_id']);
    $message = htmlentities($_POST['massage']);

    // Get meter, customer and bill information
    $customer = new \App\Model\Customer();
    $database = $meter->getDatabase();
    $data = $customer->selectWhere("customer_branch",branch_id );
 
    if (!empty($data)) { // Check if the array is not empty
        foreach ($data as $bdt) {
            $initial_unit += $bdt['customer_contact'];
            sendSingleSms($bdt['customer_contact'], $message);
        }
        $_SESSION['sms_success'] = 'Success Sending SMS';
        header('Location: ../../view/admin/smsResut.php');
    } else {
        $_SESSION['sms_success'] = 'Failed to send messages.  Street name does not exist';
        header('Location: ../../view/admin/smsResut.php');
    }

}

// form does not have token
