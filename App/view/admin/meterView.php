<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// get initial data
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../../../vendor/autoload.php';

$meter = new \App\Model\Meter();
$database = $meter->getDatabase();
$meterData = [];


if(isset($_GET['flag'])){
    $info = $_GET['flag'];
    switch ($info) {
        case 'all':
            $meterData = $database->query(
                "SELECT 
                    customer_name, customer_unique, customer_contact, customer_address, 
                    meter_number, meter_unique, meter_reg_date 
                FROM meter JOIN customer ON meter_customer =  customer_id"
            )->fetchAll();
            break;
        case 'active':
            $meterData = $database->query(
                "SELECT 
                    customer_name, customer_unique, customer_contact, meter_number, 
                    customer_address, meter_unique, meter_reg_date 
                FROM meter JOIN customer ON meter_customer =  customer_id 
                WHERE meter_lock='No'"
            )->fetchAll();
            break;
        case 'locked':
            $meterData = $database->query(
                "SELECT 
                    customer_name, customer_unique, customer_contact, meter_number, 
                    customer_address, meter_unique, meter_reg_date 
                FROM meter JOIN customer ON meter_customer =  customer_id 
                WHERE meter_lock='Yes'"
            )->fetchAll();
            break;
        case 'service':
            $meterData = $database->query(
                "SELECT 
                    customer_name, customer_unique, customer_contact, customer_address, 
                    meter_number, meter_unique, meter_reg_date 
                FROM meter JOIN customer ON meter_customer =  customer_id 
                WHERE meter_in_service='Yes'"
            )->fetchAll();
            break;
    }

}

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
                        <h4 class="m-0 font-weight-bold text-primary text-center">
                            Data of <?=$info?> meters
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Address </th>
                                        <th>Contact</th>
                                        <th>Meter number</th>
                                        <th>Reg. Date</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Address </th>
                                        <th>Contact</th>
                                        <th>Meter number</th>
                                        <th>Reg. Date</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                      foreach($meterData as $data){
                                        ?>
                                            <tr>
                                                <td><?=$data['customer_name']?></td>
                                                <td><?=$data['customer_address']?></td>
                                                <td><?=$data['customer_contact']?></td>
                                                <td><?=$data['meter_number']?></td>
                                                <td><?=$data['meter_reg_date']?></td>
                                            </tr>
                                        <?php
                                      } 
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

