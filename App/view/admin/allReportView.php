<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// get initial data
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../../../vendor/autoload.php';


$title          = $_SESSION['all_report_status'];
$start_date     = $_SESSION['all_report_start_date'];
$end_date       = $_SESSION['all_report_end_date'];

// Now get data
$rdata = [];
isset($_SESSION['all_report_data']) ? $rdata = $_SESSION['all_report_data'] : header('Location: index.php');
$totalBill = 0;
$totalPaid = 0;
$totalPayment = 0;

$bill = new \App\Model\Bill();
$database  = $bill->getDatabase();

?>

<!DOCTYPE html>
<html lang="en">

<?php require_once '../links.php'; ?>
<?php require_once './helpers/gaurd.php' ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require_once './partials/sidebar.php' ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php require_once './partials/topbar.php' ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Report Information</h1>

                </div>
                <!-- /.container-fluid -->
                <div class="container-fluid">
                <div class="card shadow mb-4 border-left-success ">
                    <div class="card-header py-3">
                        <?php include_once './partials/success_messages.php' ?>
                        <h4 class="m-0 font-weight-bold text-primary text-center">
                            Data of <?=$title?> from <?=$start_date?> to <?=$end_date?>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php 
                            if($title == "Customers"){
                            ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Gender </th>
                                                <th>Contact</th>
                                                <th>Branch</th>
                                                <th>Address</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Gender </th>
                                                <th>Contact</th>
                                                <th>Branch</th>
                                                <th>Street</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                                foreach($rdata as $data){
                                                    ?>
                                                    <tr>
                                                        <td><?=$data['customer_name']?></td>
                                                        <td><?=$data['customer_gender']?></td>
                                                        <td><?=$data['customer_contact']?></td>
                                                        <td><?=$data['branch_name']?></td>
                                                        <td><?=$data['customer_address']?></td>
                                                        <td>
                                                            <a href="./customerView.php?id=<?=$data['customer_unique']?>" class="btn btn-block btn-sm btn-warning ">View</a> 
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }    
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                                <hr>
                            <?php
                            }
                            else if($title == "Meters"){
                            ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Address </th>
                                                <th>Contact</th>
                                                <th>Meter number</th>
                                                <th>Reg. Date</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Address </th>
                                                <th>Contact</th>
                                                <th>Meter number</th>
                                                <th>Reg. Date</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            foreach($rdata as $data){
                                                ?>
                                                    <tr>
                                                        <td><?=$data['customer_name']?></td>
                                                        <td><?=$data['customer_address']?></td>
                                                        <td><?=$data['customer_contact']?></td>
                                                        <td><?=$data['meter_number']?></td>
                                                        <td><?=$data['meter_reg_date']?></td>
                                                    </tr>
                                                <?php
                                            } 
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                                <hr>
                            <?php
                            }
                            else if($title == "Bills"){
                            ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Address </th>
                                                <th>Contact</th>
                                                <th>Bill</th>
                                                <th>Paid</th> 
                                                <th>Debt</th> 
                                                <th>Bill Date</th>  
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Address </th>
                                                <th>Contact</th>
                                                <th>Bill</th>
                                                <th>Paid</th> 
                                                <th>Debt</th> 
                                                <th>Bill Date</th>  
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            foreach($rdata as $data){
                                                $totalBill += $data['bill_cost'];
                                                $totalPaid +=  intval($data['paid']);

                                                ?>
                                                    <tr>
                                                        <td><?=$data['customer_name']?></td>
                                                        <td><?=$data['customer_address']?></td>
                                                        <td><?=$data['customer_contact']?></td>
                                                        <td><?=$data['bill_cost']?></td>
                                                        <td><?=$data['paid']?></td>
                                                        <td><?=$data['bill_cost'] - intval($data['paid']) ?></td>
                                                        <td><?=$data['bill_reg_date']?></td>
                                                    </tr>
                                                <?php
                                            } 
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                                <hr>
                                <h6 class="m-0 font-weight-bold text-primary">Total Bill : <?=$totalBill?> </h6>
                                <h6 class="m-0 font-weight-bold text-primary">Total Paid : <?=$totalPaid?> </h6>
                                <h6 class="m-0 font-weight-bold text-primary">Debt : <?=$totalBill - $totalPaid?> </h6>
                            <?php
                            }
                            else if($title == "Payment"){
                            ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Address </th>
                                                <th>Contact</th>
                                                <th>Method</th>
                                                <th>Type</th> 
                                                <th>Amout</th> 
                                                <th>Bill Date</th>  
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Address </th>
                                                <th>Contact</th>
                                                <th>Method</th>
                                                <th>Type</th> 
                                                <th>Amout</th> 
                                                <th>Bill Date</th>  
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            foreach($rdata as $data){
                                                $totalPayment +=  intval($data['pay_amount']);

                                                ?>
                                                    <tr>
                                                        <td><?=$data['customer_name']?></td>
                                                        <td><?=$data['customer_address']?></td>
                                                        <td><?=$data['customer_contact']?></td>
                                                        <td><?=$data['pay_method']?></td>
                                                        <td><?=$data['pay_type']?></td>
                                                        <td><?=$data['pay_amount']?></td>
                                                        <td><?=$data['pay_reg_date']?></td>
                                                    </tr>
                                                <?php
                                            } 
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                                <hr>
                                <h6 class="m-0 font-weight-bold text-primary">Total Payment : <?=$totalPayment?> </h6>
                            <?php
                            }
                            else if($title == "General"){
                            ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Data </th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Item</th>
                                                <th>Data </th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <tr>
                                                <td>Customers</td>
                                                <td><?=$rdata['customers']?></td>
                                            </tr>
                                            <tr>
                                                <td>Customer Meters</td>
                                                <td><?=$rdata['meters']?></td>
                                            </tr>
                                            <tr>
                                                <td>Bills Amount</td>
                                                <td><?=$rdata['bills']?></td>
                                            </tr>
                                            <tr>
                                                <td>Bills Paid (Payments) Amount</td>
                                                <td><?=$rdata['payments']?></td>
                                            </tr>
                                            <tr>
                                                <td>Bills Unpaid  Amount</td>
                                                <td><?=$rdata['un_paid_bills']?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                                <hr>
                                <h6 class="m-0 font-weight-bold text-primary">Total Payment : <?=$totalPayment?> </h6>
                            <?php
                            }
                            else{
                                ?> 
                                    <h1>No Data Supplied</h1>
                                <?php
                            }
                        ?>
                        
                    </div>
                </div>

            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
   
    <?php require_once '../scripts.php'; ?>
</body>
</html>

