<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// get initial data
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../../../vendor/autoload.php';

$address = new \App\Model\Address();
$database = $address->getDatabase();

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
                    <h1 class="h3 mb-4 text-gray-800">Address</h1>

                </div>
                <!-- /.container-fluid -->
                <div class="container-fluid">
                <div class="card shadow mb-4 border-left-success ">
                    <div class="card-header py-3">
                        <?php include_once './partials/success_messages.php' ?>
                        <a href="./addAddress.php" class="btn btn-primary m-0 font-weight-bold text-white">
                            Add Address
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Branch</th>
                                        <th>Reg. Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Branch</th>
                                        <th>Reg. Date</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                   <?php
                                        $database->select($address->table_name, [
                                            "[>]branch" => ["address_branch" => "branch_id"]
                                        ], [
                                            "branch_name", "address_unique", 
                                            "address_name", "address_reg_date"
                                        ],
                                        function($data){
                                            ?>
                                            <tr>
                                                <td><?=$data['address_name']?></td>
                                                <td><?=$data['branch_name']?></td>
                                                <td><?=$data['address_reg_date']?></td>
                                                <td>
                                                    <a href="./updateAddress.php?id=<?=$data['address_unique']?>" class="btn btn-sm btn-success">Update</a> 
                                                    <a href="./deleteAddress.php?id=<?=$data['address_unique']?>" class="btn btn-sm btn-danger">Delete</a> 
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