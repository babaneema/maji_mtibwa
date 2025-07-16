<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// get initial data
require_once './helpers/customer.php';


?>

<!DOCTYPE html>
<html lang="en">

<?php require_once '../links.php'; ?>

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
                    <h1 class="h3 mb-4 text-gray-800">Bills</h1>

                </div>
                <!-- /.container-fluid -->
                <div class="container-fluid">
                <div class="card shadow mb-4 border-left-success ">
                    <div class="card-header py-3">
                        <?php include_once './partials/success_messages.php' ?>
                        <h6 class="m-0 font-weight-bold text-primary"><?=$data[0]['customer_name']?></h6>
                    </div>
                    <div class="card-body">
                        <h6 class="m-0 font-weight-bold text-primary">Bill Information</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Unit Used</th>
                                        <th>Bill</th>
                                        <th>Paid</th>
                                       
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Date</th>
                                        <th>Unit Used</th>
                                        <th>Bill</th>
                                        <th>Paid</th>
                                      
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                        foreach($bdata as $data){
                                            $totalBill += $data['bill_cost']
                                            ?>
                                                <tr>
                                                    <td><?=$data['bill_reg_date']?></td>
                                                    <td><?=$data['bill_unit_used']?></td>
                                                    <td><?=$data['bill_cost']?></td>
                                                    <th>
                                                        <?php
                                                            echo $pdatabase->sum(
                                                                $payment->table_name, "pay_amount", ["pay_bill" => $data['bill_id']] 
                                                            );
                                                        ?>
                                                    </th>
                                                   
                                                </tr>
                                            <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>


                        <br>
                        <hr>
                        <h6 class="m-0 font-weight-bold text-primary">Payment Information</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="data1" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Bill</th>
                                        <th>Paid</th>
                                       
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Date</th>
                                        <th>Bill</th>
                                        <th>Paid</th>
                                       
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                        foreach($pdata as $data){
                                            $totalPaid +=$data['pay_amount']
                                            ?>
                                                <tr>
                                                    <td><?=$data['pay_reg_date']?></td>
                                                    <td><?=$data['bill_cost']?></td>
                                                    <td><?=$data['pay_amount']?></td>
                                                   
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

