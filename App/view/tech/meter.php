<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// get initial data
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../../../vendor/autoload.php';
$_SESSION['_filterMeter_token'] = bin2hex(random_bytes(32));

$meter = new \App\Model\Meter();
$database = $meter->getDatabase();


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
                    <h1 class="h3 mb-4 text-gray-800">Meter</h1>

                </div>
                <!-- /.container-fluid -->
                <div class="container-fluid">
                <div class="card shadow mb-4 border-left-success ">
                    <div class="card-header py-3">
                        <?php include_once './partials/success_messages.php' ?>
                        <h5 class=" m-0 font-weight-bold text-primary">
                           Meter Information
                    </h5>
                    </div>
                    <div class="card-body">
                        
                        <h4 class="m-0 font-weight-bold text-primary text-center">
                            Meter Filter
                        </h4>
                        <br>
                        <form action="../../controller/tech/processFilterMeter.php" method="post">
                            <input type="hidden" name="token" value="<?=$_SESSION['_filterMeter_token']?>">
                            <div class="row form-group">
                                <label for="Name" class="col-lg-2 form-control-label">
                                    Status
                                </label>
                                <select name="meter" class="col-lg-3 form-control" required>
                                    <option value="read">Read</option>
                                    <option value="unread">Unread</option>
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