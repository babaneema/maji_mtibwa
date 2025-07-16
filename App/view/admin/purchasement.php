<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// get initial data
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../../../vendor/autoload.php';
$_SESSION['_billMeter_token'] = bin2hex(random_bytes(32));

$purchasement = new \App\Model\Purchasement();
$database = $purchasement->getDatabase();


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
                    <h1 class="h3 mb-4 text-gray-800">Purchasement</h1>

                </div>
                <!-- /.container-fluid -->
                <div class="container-fluid">
                <div class="card shadow mb-4 border-left-success ">
                    <div class="card-header py-3">
                        <?php include_once './partials/success_messages.php' ?>
                        <h5 class="m-0 font-weight-bold text-primary">
                            Purchasement Information
                        </h5>
                    </div>
                    <div class="card-body">
                    <div class="card-header py-3">
                        <?php include_once './partials/success_messages.php' ?>
                        <a href="addPurchasement.php" class="btn btn-primary m-0 font-weight-bold text-white">
                            Add Purchasement
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                      <th>Name</th>  
                                      <th>Type</th>  
                                      <th>Company</th>  
                                      <th>Category</th>  
                                      <th>Unit</th>  
                                      <th>Price</th>
                                      <th>Quantity</th>
                                      <th>Total</th>
                                      <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                      <th>Name</th>  
                                      <th>Type</th>  
                                      <th>Company</th>  
                                      <th>Category</th>  
                                      <th>Unit</th>  
                                      <th>Price</th>
                                      <th>Quantity</th>
                                      <th>Total</th>
                                      <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                        $database->select($purchasement->table_name, [
                                            "[>]equipment" => ["purchasement_equipment" => "equipment_id"],
                                            "[>]category" => ["purchasement_category" => "catgory_id"]
                                        ], [
                                            "equipment_name", "equipment_company", "equipment_type",
                                            "purchasement_measurement", "purchasement_price", "purchasement_quantity",
                                            "category_name"
                                            
                                        ], function($data){
                                            ?>
                                            <tr>
                                                <td><?=$data["equipment_name"]?></td>
                                                <td><?=$data["equipment_type"]?></td>
                                                <td><?=$data["equipment_company"]?></td>
                                                <td><?=$data["category_name"]?></td>
                                                <td><?=$data["purchasement_measurement"]?></td>
                                                <td><?=$data["purchasement_price"]?></td>
                                                <td><?=$data["purchasement_quantity"]?></td>
                                                <td><?=$data["purchasement_price"] * $data["purchasement_quantity"]?></td>
                                                <td>
                                                    <a href="" class="btn btn-sm btn-success" >Update</a>
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