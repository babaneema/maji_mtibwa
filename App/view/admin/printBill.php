<?php
  require_once '../../../vendor/autoload.php';
  
  $id = 0;
  if(!isset($_GET['id'])) header('Location: ./index.php');
  $id = $_GET['id'];

  $customerBill = new \App\Model\Bill();
  $database = $customerBill->getDatabase();
  $customerBillData = $database->select($customerBill->table_name, "*", [
    'bill_unique' => $id
  ]);
    

  $customer = new \App\Model\Customer();
  $customerData = $database->select($customer->table_name, "*", [
    'customer_id' => $customerBillData[0]['bill_customer']
  ]);


  $payment = new \App\Model\Payment();
  $paymentData = $database->select($payment->table_name, "*", [
    'pay_bill' => $customerBillData[0]['bill_id']
  ]);
  

  // Branch Information 
  $branch = new \App\Model\Branch();
  $branch_id = $customerData[0]['customer_branch'];
  $branchData = $database->select($branch->table_name, "*", [
    'branch_id' => $branch_id
  ]);


  $branch_name = $branchData[0]['branch_name'];

  
  // Unit Information
  $badData = [];
  $unit = new \App\Model\Unit();
  $unit_data = $database->select($unit->table_name, "*");

  foreach($unit_data as $uniData){
    if($uniData['branch_name'] == $branch_name){
      $badData[] = $uniData;
    }
  }

  $unitPrice = '';
  if(count($badData) > 1){
    $unitPrice = $badData[count($badData) - 1]['unit_price'];
  }else{
    $unitPrice = $badData[0]['unit_price'];
  }

  
//   var_dump($customerBillData[0]);
//   var_dump($paymentData[0]);
//   die();
  
  $customer_name = $customerData[0]['customer_name']; 
  $customer_address = $customerData[0]['customer_address']; 
  $customer_contact = $customerData[0]['customer_contact']; 

  $unit_used = $customerBillData[0]['bill_unit_used'];
  $bill_cost = $customerBillData[0]['bill_cost'];
  $bill_reg_date = $customerBillData[0]['bill_reg_date'];

  $time = strtotime($bill_reg_date);
  $newformat = date('Y-m-d',$time);
  
  
  use Konekt\PdfInvoice\InvoicePrinter;

  $invoice = new InvoicePrinter('A4', 'Tsh', 'en');

  $invoice_number = ' MZNG-WT : 0';
 
  
  /* Header settings */
//   $invoice->setLogo("images/sample1.jpg");   //logo image path
  $invoice->setColor("#007fff");      // pdf color scheme
  $invoice->setType(" MZINGA MAJI");    // Invoice Type
  $invoice->setReference( $invoice_number);   // Reference
  $invoice->setDate($newformat);   //Billing Date
  $invoice->setTime(date(' h:i:s A',time()));   //Billing Time
  $invoice->setDue(date($bill_reg_date,strtotime('+15 day')));    // Due Date
  $invoice->setFrom(array("Prodiver Name","Mzinga Maji","Mbagala","Dar es Salaam , Box ...."));
  $invoice->setTo(
      array(
          "Customer Name",
          $customer_name,
          $customer_address,
          $customer_contact
        )
    );
  
  $invoice->addItem(
      "Bill ya maji ya mwezi",
      "",
      $unit_used,
      0,
      $unitPrice,
      0,
      $bill_cost
    );
//   $invoice->addItem("PDC-E5300","2.6GHz/1GB/320GB/SMP-DVD/FDD/VB",4,0,645,0,2580);
//   $invoice->addItem('LG 18.5" WLCD',"",10,0,230,0,2300);
//   $invoice->addItem("HP LaserJet 5200","",1,0,1100,0,1100);
  
  $invoice->addTotal("Total", $bill_cost);
//   $invoice->addTotal("VAT 21%",1986.6);
  $invoice->addTotal("Total due",$bill_cost,true);
  
//   $invoice->addBadge("Payment Paid");
  
  $invoice->addTitle("Important Notice");
  
  $invoice->addParagraph("Pay on time to avoid service termination.");
  
  $invoice->setFooternote("Mzinga Maji ");
  
  $invoice->render('bill.pdf','I'); 