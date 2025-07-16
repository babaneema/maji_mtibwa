<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// get initial data
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../../../vendor/autoload.php';

$unit = new \App\Model\Unit();
$database = $unit->getDatabase();

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
                    <h1 class="h3 mb-4 text-gray-800">Units</h1>

                </div>
                <!-- /.container-fluid -->
                <div class="container-fluid">
                <div class="card shadow mb-4 border-left-success ">
                    <div class="card-header py-3">
                        <?php include_once './partials/success_messages.php' ?>
                        <a href="./addUnit.php" class="btn btn-primary m-0 font-weight-bold text-white">
                            Add Unit
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Branch</th>
                                        <th>Unit</th>
                                        <th>Reg. Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Branch</th>
                                        <th>Unit</th>
                                        <th>Reg. Date</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                        $database->select($unit->table_name, [
                                            "[>]branch" => ["unit_branch" => "branch_id"]
                                        ], [
                                            "branch_name",  'unit_id', 'unit_unique', 'unit_branch', 
                                            'unit_price', 'unit_reg_date'
                                        ],
                                        function($data){
                                            ?>
                                            <tr>
                                                <td><?=$data['branch_name']?></td>
                                                <td><?=$data['unit_price']?></td>
                                                <td><?=$data['unit_reg_date']?></td>
                                                <td>
                                                    <a href="" class="btn btn-sm btn-success">Update</a> 
                                                    <a href="" class="btn btn-sm btn-danger">Delete</a> 
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