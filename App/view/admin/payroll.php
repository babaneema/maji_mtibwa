<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// get initial data
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../../../vendor/autoload.php';
$_SESSION['_filterAllPayroll_token'] = bin2hex(random_bytes(32));

$employee = new \App\Model\Employee();
$database = $employee->getDatabase();


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
                    <h1 class="h3 mb-4 text-gray-800">Payroll</h1>

                </div>
                <!-- /.container-fluid -->
                <div class="container-fluid">
                <div class="card shadow mb-4 border-left-success ">
                    <div class="card-header py-3">
                        <?php include_once './partials/success_messages.php' ?>
                        
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
                                                    All Employee : <?php echo $database->count($employee->table_name) ?>
                                                </div>
                                                
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
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
                            Payroll Filter
                        </h4>
                        <br>
                        <form action="../../controller/admin/processFilterAllPayrol.php" method="post">
                            <input type="hidden" name="token" value="<?=$_SESSION['_filterAllPayroll_token']?>">
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