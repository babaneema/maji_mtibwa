<?php header("X-XSS-Protection: 0"); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) session_start();
$_SESSION['_addReadMeter_token'] = bin2hex(random_bytes(32));
require_once '../../../vendor/autoload.php';

$meter = new \App\Model\Meter();


$id = isset($_GET['id']) ? $_GET['id'] : header('Location: ../auth/logout.php');
$database = $meter->getDatabase();

$data = $database->select($meter->table_name,
    [
        "[><]customer" => ["meter_customer" => "customer_id"],
    ],
    [
        'meter_id', 'meter_unique', 'meter_intital_unit',
        'meter_lock', 'customer_name', 'customer_contact', 'customer_address',
        'customer_id'
    ],
    [
        "meter_unique" => $id
    ]
);
$cust_id = $data[0]['customer_id'];

$sum_unit_used = $database->sum('bill', 'bill_unit_used', ['bill_customer' => $cust_id]);

$initial_unit = $data[0]['meter_intital_unit'];
$last_unit = (float) $initial_unit + (float) $sum_unit_used;

// var_dump($last_unit);
// die();


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
                    <h1 class="h3 mb-4 text-gray-800">Meter Read</h1>

                </div>
                <!-- /.container-fluid -->
                <div class="container-fluid">
                    <div class="card shadow mb-4 border-left-success ">
                        <div class="card-header py-3">
                            <?php include_once './partials/error_messages.php' ?>
                            <h6 class="m-0 font-weight-bold text-primary">
                                Read Meter
                            </h6>
                        </div>
                        <div class="card-body">
                            <form action="../../controller/admin/processMeterRead.php" method="post">
                                <input type="hidden" name="token" value="<?=$_SESSION['_addReadMeter_token']?>">
                                <input type="hidden" name="meter_id" value="<?=$id?>" >
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                        Customer Name
                                    </label>
                                    <input type="text" value="<?=$data[0]['customer_name']?>" class="col-lg-3 form-control" readonly>
                                </div>
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                        Phone Number
                                    </label>
                                    <input type="text" value="<?=$data[0]['customer_contact']?>" class="col-lg-3 form-control" readonly>
                                </div>
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                       Street
                                    </label>
                                    <input type="text" value="<?=$data[0]['customer_address']?>" class="col-lg-3 form-control" readonly>
                                </div>
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                        Last Reading
                                    </label>
                                    <input type="text" value="<?=$last_unit?>" class="col-lg-3 form-control" readonly>
                                </div>
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                        New Reading
                                    </label>
                                    <input type="number" name="reading" min="<?=$last_unit?>" class="col-lg-3 form-control" required>
                                </div>
                                <div class="row">
                                    <button type="submit" class="btn btn-success btn-block col-lg-3 offset-lg-2">Read</button>
                                </div>
                            </form>
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