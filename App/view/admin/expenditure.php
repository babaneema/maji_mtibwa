<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// get initial data
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../../../vendor/autoload.php';

$expenditure = new \App\Model\Expenditure();
$database = $expenditure->getDatabase();

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
                    <h1 class="h3 mb-4 text-gray-800">Expenditure</h1>

                </div>
                <!-- /.container-fluid -->
                <div class="container-fluid">
                <div class="card shadow mb-4 border-left-success ">
                    <div class="card-header py-3">
                        <?php include_once './partials/success_messages.php' ?>
                        <a href="addExpenditure.php" class="btn btn-primary m-0 font-weight-bold text-white">
                            Add Expenditure
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                       <th>Item</th>
                                       <th>Cost</th>
                                       <th>Date</th>
                                       <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                       <th>Item</th>
                                       <th>Cost</th>
                                       <th>Date</th>
                                       <th>Action</th>
                                    </tr>
                                <tbody>
                                    <?php
                                        $database->select($expenditure->table_name,  [
                                           "expenditure_title", "expenditure_reg_date", "expenditure_amount",
                                           "expenditure_unique"
                                        ],
                                        function($data){
                                            ?>
                                            <tr>
                                                <td><?=$data['expenditure_title']?></td>
                                                <td><?=$data['expenditure_reg_date']?></td>
                                                <td><?=$data['expenditure_amount']?></td>
                                                <td>
                                                    <a href="./expenditureView.php?id=<?=$data['expenditure_unique']?>" class="btn btn-block btn-sm btn-warning ">View</a> 
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