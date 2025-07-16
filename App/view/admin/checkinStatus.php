<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// get initial data
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../../../vendor/autoload.php';
$id = isset($_GET['id']) ? $_GET['id'] : header('Location: ../auth/logout.php');

$employee = new \App\Model\Employee();
$database = $employee->getDatabase();

$data = $database->select($employee->table_name, "*", ["employee_unique" => $id]);

$employee_id = $data[0]['employee_id'];

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
                    <h1 class="h3 mb-4 text-gray-800">Employees Checkin (<?=$data[0]['employee_name']?>)</h1>

                </div>
                <!-- /.container-fluid -->
                <div class="container-fluid">
                <div class="card shadow mb-4 border-left-success ">
                    <div class="card-header py-3">
                        <?php include_once './partials/success_messages.php' ?>
                        <a href="../../controller/admin/processEmployeeChecking.php?id=<?=$id?>" class="btn btn-primary m-0 font-weight-bold text-white">
                            Check In Today
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time In </th>
                                        <th>Time Out</th>
                                        <!-- <th>Hours</th> -->
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time In </th>
                                        <th>Time Out</th>
                                        <!-- <th>Hours</th> -->
                                    </tr>
                                </tfoot>
                                <tbody>
                                   <?php
                                   $database->select('checkin', "*", ["checkin_employee" => $employee_id ],
                                    function($data){
                                        ?>
                                        <tr>
                                            <td><?=$data['checkin_reg_date']?></td>
                                            <td><?=$data['checkin_in']?></td>
                                            <td>
                                                <?php
                                                if($data['checkin_out'] == ''){
                                                    ?>
                                                    <a href="../../controller/admin/processCheckout.php?id=<?=$data['checkin_unique']?>" 
                                                        class="btn btn-sm btn-warning" >
                                                        Check out
                                                    </a>
                                                    <?php
                                                } 
                                                else {
                                                    echo $data['checkin_out'];
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php 
                                    }
                                    ); 
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