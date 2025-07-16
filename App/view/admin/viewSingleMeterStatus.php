<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// get initial data
if (session_status() === PHP_SESSION_NONE) session_start();
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

$bdata = $database->query(
    "SELECT bill_reg_date, bill_unit_used, bill_cost, bill_unit,bill_id, bill_unique
    FROM bill 
    WHERE bill_customer=$cust_id"
    )->fetchAll();

$initial_unit = $data[0]['meter_intital_unit'];
// var_dump($initial_unit);
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
                    <h1 class="h3 mb-4 text-gray-800">Meter</h1>

                </div>
                <!-- /.container-fluid -->
                <div class="container-fluid">
                <div class="card shadow mb-4 border-left-success ">
                    <div class="card-header py-3">
                        <?php include_once './partials/success_messages.php' ?>
                        <a href="readMeter.php?id=<?=$id?>" class="btn btn-success m-0 mb-3 font-weight-bold text-white">
                           Read
                        </a>
                        <h5 class="m-0 font-weight-bold text-primary">
                            <?=$data[0]['customer_name']?> | <?=$data[0]['customer_contact']?>
                        </h5>
                    </div>
                    <div class="card-body">
                        
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>From </th>
                                        <th>To</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Date</th>
                                        <th>From </th>
                                        <th>To</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                  <?php
                                    foreach ($bdata as $data) {
                                       ?>
                                       <tr>
                                        <td><?=$data['bill_reg_date']?></td>
                                        <td> <?=$initial_unit?> </td>
                                        <td>
                                            <?php
                                            echo $initial_unit += $data['bill_unit_used'] 
                                            ?>
                                        </td>
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

