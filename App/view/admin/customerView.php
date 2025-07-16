<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// get initial data
require_once './helpers/customer.php';
$cust_uniqu = $data[0]['customer_unique'];

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
                    <h1 class="h3 mb-4 text-gray-800">Customer</h1>

                </div>
                <!-- /.container-fluid -->
                <div class="container-fluid">
                <div class="card shadow mb-4 border-left-success ">
                    <div class="card-header py-3">
                        <?php include_once './partials/success_messages.php' ?>
                        <h6 class="m-0 font-weight-bold text-primary">Customer Details</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-group w-50">
                            <li class="list-group-item">Name : <?=$data[0]['customer_name']?> </li>
                            <li class="list-group-item">Gender :  <?=$data[0]['customer_gender']?></li>
                            <li class="list-group-item">Contact :  <?=$data[0]['customer_contact']?></li>
                            <li class="list-group-item">Address :  <?=$data[0]['customer_address']?></li>
                            <li class="list-group-item">Branch :  <?=$data[0]['branch_name']?></li>
                            <li class="list-group-item">Unit Price : <?=$data[0]['branch_name']?> </li>
                            <li class="list-group-item">House Number : <?=$data[0]['customer_house_number']?></li>
                            <li class="list-group-item">Status : <?=!empty($meterData[0]['meter_lock']) ?$meterData[0]['meter_lock'] : ''?>  </li>
                            <li class="list-group-item">
                                <a href="updateCustomer.php?id=<?=$data[0]['customer_unique']?>" class="btn btn-sm btn-success">Update</a>
                                <a href="../../controller/admin/processDeleteCustomer.php?id=<?=$data[0]['customer_unique']?>" 
                                    class="btn btn-sm btn-danger">
                                    Delete
                                </a>
                            </li>
                        </ul>

                        <br>
                        <hr>

                        <h6 class="m-0 font-weight-bold text-primary">Meter Information</h6>
                        <a href="./addMeter.php?id=<?=$data[0]['customer_unique']?>" 
                            class="btn btn-sm btn-primary m-0 font-weight-bold text-white">
                            Add Meter 
                        </a>    
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Meter Number</th>
                                        <th>Lock Status</th>
                                        <th>Initial Unit</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Meter Number</th>
                                        <th>Lock Status</th>
                                        <th>Initial Unit</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                        foreach($meterData as $mdata){
                                            ?>
                                                <tr>
                                                    <td><?=$mdata['meter_number']?></td>
                                                    <td><?=$mdata['meter_lock']?></td>
                                                    <td><?=$mdata['meter_intital_unit']?></td>
                                                    <td>
                                                        <a href="../../controller/admin/processLockMeter.php?id=<?=$mdata['meter_unique']?>&customer=<?=$data[0]['customer_unique']?>" 
                                                            class="btn btn-sm btn-info">
                                                            <?php  echo ($mdata["meter_lock"] == "Yes") ? "Unlock" : "Lock"; ?>
                                                        </a>
                                                        <a href="updateMeter.php?id=<?=$mdata['meter_unique']?>"
                                                            class="btn btn-sm btn-success">
                                                            Update
                                                        </a>
                                                        <a href="../../controller/admin/processDeleteMeter.php?id=<?=$mdata['meter_unique']?>&customer=<?=$cust_uniqu ?>" 
                                                            class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete meter ?');">
                                                            Delete
                                                        </a>
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
                        <h6 class="m-0 font-weight-bold text-primary">Bill Information</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="data1" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Unit Used</th>
                                        <th>Bill</th>
                                        <th>Paid</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Date</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Unit Used</th>
                                        <th>Bill</th>
                                        <th>Paid</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                        foreach($bdata as $data){
                                            $totalBill += $data['bill_cost'];
                                            $paid =  $pdatabase->sum(
                                                $payment->table_name, "pay_amount", ["pay_bill" => $data['bill_id']] 
                                            );
                                            ?>
                                                <tr>
                                                    <td><?=$data['bill_reg_date']?></td>
                                                    <td><?=$initial_unit?> </td>
                                                    <td><?=$initial_unit += $data['bill_unit_used']?></td>
                                                    <td><?=$data['bill_unit_used']?></td>
                                                    <td><?=$data['bill_cost']?></td>
                                                    <th> <?=$paid?> </th>
                                                    <td>
                                                        <a href="payBill.php?id=<?=$data['bill_unique']?>" class="btn btn-sm btn-info">Pay</a>
                                                        <a href="../../controller/admin/processDeleteBill.php?id=<?=$data['bill_unique']?>&customer=<?=$cust_uniqu ?>" 
                                                            onclick="return confirm('Are you sure you want to delete?');"
                                                            class="btn btn-sm btn-danger">
                                                            Delete
                                                        </a>
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
                        <h6 class="m-0 font-weight-bold text-primary">Payment Information</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="print" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Bill</th>
                                        <th>Paid</th>
                                        <th>Paid Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Date</th>
                                        <th>Bill</th>
                                        <th>Paid</th>
                                        <th>Paid Date</th>
                                        <th>Action</th>
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
                                                    <td><?=$data['pay_amount']?></td>
                                                    <td>
                                                        <a href="../../controller/admin/processDeletePayments.php?id=<?=$data['pay_unique']?>&customer=<?=$cust_uniqu ?>" 
                                                            class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete payment ?');">
                                                            Delete
                                                        </a>
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