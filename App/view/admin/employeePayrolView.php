<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// get initial data
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../../../vendor/autoload.php';

$totalPayee = 0;
$start_date = $_SESSION['payroll_all_start_date'];
$end_date = $_SESSION['payroll_all_end_date'];


// Now get data
$pdata = [];
isset($_SESSION['employee_payrol_all_data']) ? $pdata = $_SESSION['employee_payrol_all_data'] : header('Location: index.php');
// echo sizeof($pdata);
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
                    <h1 class="h3 mb-4 text-gray-800">App Payroll</h1>

                </div>
                <!-- /.container-fluid -->
                <div class="container-fluid">
                <div class="card shadow mb-4 border-left-success ">
                    <div class="card-header py-3">
                        <?php include_once './partials/success_messages.php' ?>
                        <h4 class="m-0 font-weight-bold text-primary text-center">
                            Payrolls from : <?=$start_date?> To <?=$end_date?>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th>Amount</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                      foreach($pdata as $data){
                                        $totalPayee += intval($data['amount']);
                                        ?>
                                            <tr>
                                                <td><?=$data['employee_name']?></td>
                                                <td><?=$data['employee_contact']?></td>
                                                <td><?=$data['amount']?></td>
                                            </tr>
                                        <?php
                                      } 
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <br>
                        <hr>
                        <h6 class="m-0 font-weight-bold text-primary">Total Payment : <?=$totalPayee?> </h6>
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

