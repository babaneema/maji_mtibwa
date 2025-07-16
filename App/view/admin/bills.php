<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// get initial data
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../../../vendor/autoload.php';
$_SESSION['_billMeter_token'] = bin2hex(random_bytes(32));

$bill = new \App\Model\Bill();
$database = $bill->getDatabase();


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
                    <h1 class="h3 mb-4 text-gray-800">Bills</h1>

                </div>
                <!-- /.container-fluid -->
                <div class="container-fluid">
                <div class="card shadow mb-4 border-left-success ">
                    <div class="card-header py-3">
                        <?php include_once './partials/success_messages.php' ?>
                        <h5 class="m-0 font-weight-bold text-primary">
                            Bill Information
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    All Bill</div>
                                                <a href="" class="user-select-auto h5 mb-0 font-weight-bold text-gray-800">
                                                    <?= $database->count($bill->table_name) ?>
                                                </a>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Bill Values</div>
                                                <a href="" class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?= $database->sum($bill->table_name, "bill_cost") ?>
                                                     <!--<?= number_format($database->sum($bill->table_name, "bill_cost")) ?>-->
                                                </a>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    Paid  
                                                </div>
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-auto">
                                                        <a href="" class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        <?= $database->sum("payments", "pay_amount") ?>
                                                        </a>
                                                    </div>
                                                    <div class="col">
                                                        <div class="progress progress-sm mr-2">
                                                            <div class="progress-bar bg-info" role="progressbar"
                                                                style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                                aria-valuemax="100">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pending Requests Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                    Debt
                                                </div>
                                                <a href="" class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?= $database->sum($bill->table_name, "bill_cost") - $database->sum("payments", "pay_amount") ?>
                                                </a>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <hr>
                        <h4 class="m-0 font-weight-bold text-primary text-center">
                            Bill Filter
                        </h4>
                        <br>
                        <form action="../../controller/admin/processBillFilter.php" method="post">
                            <input type="hidden" name="token" value="<?=$_SESSION['_billMeter_token']?>">
                            <div class="row form-group">
                                <label for="Name" class="col-lg-2 form-control-label">
                                    Status
                                </label>
                                <select name="bill" class="col-lg-3 form-control" required>
                                    <option value="paid">Paid</option>
                                    <option value="unpaid">Unpaid</option>
                                </select>
                            </div>
                            <div class="row form-group">
                                <label for="Name" class="col-lg-2 form-control-label">
                                    Start Date
                                </label>
                                <input name="start_date" type="date" class="col-lg-3 form-control" required>
                            </div>
                            <div class="row form-group">
                                <label for="Name" class="col-lg-2 form-control-label">
                                    End Date
                                </label>
                                <input name="end_date" type="date" class="col-lg-3 form-control" required>
                            </div>
                            <div class="row">
                                <button type="submit" class="btn btn-success btn-block col-lg-3 offset-lg-2">Search</button>
                            </div>
                        </form>
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