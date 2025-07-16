<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// get initial data
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../../../vendor/autoload.php';

$customer = new \App\Model\Customer();
$database = $customer->getDatabase();

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
                        
                    </div>
                    <div class="card-body">
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
                                        $database->select($customer->table_name, [
                                            "[>]branch" => ["customer_branch" => "branch_id"]
                                        ], [
                                            "branch_name", "customer_unique", 
                                            "customer_name", "customer_gender", "customer_contact",
                                            "customer_reg_date", "customer_address"
                                        ],
                                        function($data){
                                            ?>
                                            <tr>
                                                <td><?=$data['customer_name']?></td>
                                                <td><?=$data['customer_gender']?></td>
                                                <td><?=$data['customer_contact']?></td>
                                                <td><?=$data['branch_name']?></td>
                                                <td><?=$data['customer_address']?></td>
                                                <td>
                                                    <a href="./viewBills.php?id=<?=$data['customer_unique']?>" class="btn btn-block btn-sm btn-warning ">View</a> 
                                                </td>
                                            </tr>
                                            <?php 
                                        }); 
                                   ?>
                                </tbody>
                            </table>
                        </div>
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