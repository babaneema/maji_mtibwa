<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// get initial data
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../../../vendor/autoload.php';
$_SESSION['_billMeter_token'] = bin2hex(random_bytes(32));

$equipment = new \App\Model\Equipment();
$database = $equipment->getDatabase();


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
                    <h1 class="h3 mb-4 text-gray-800">Equipments</h1>

                </div>
                <!-- /.container-fluid -->
                <div class="container-fluid">
                <div class="card shadow mb-4 border-left-success ">
                    <div class="card-header py-3">
                        <?php include_once './partials/success_messages.php' ?>
                        <h5 class="m-0 font-weight-bold text-primary">
                            Equipments Information
                        </h5>
                    </div>
                    <div class="card-body">
                    <div class="card-header py-3">
                        <?php include_once './partials/success_messages.php' ?>
                        <a href="addEquipment.php" class="btn btn-primary m-0 font-weight-bold text-white">
                            Add Equipment
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
                                      <th>Date</th>  
                                      <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                      <th>Name</th>  
                                      <th>Type</th>  
                                      <th>Company</th>  
                                      <th>Date</th>  
                                      <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                        $database->select($equipment->table_name, "*",
                                        function($data){
                                            ?>
                                            <tr>
                                                <td><?=$data['equipment_name']?></td>
                                                <td><?=$data['equipment_type']?></td>
                                                <td><?=$data['equipment_company']?></td>
                                                <td><?=$data['equipment_reg_date']?></td>
                                                <td>
                                                    <a href="updateEquipment.php?id=<?=$data['equipment_unique']?>" class="btn btn-sm btn-sm btn-success">Update</a> 
                                                    <a href="" class="btn btn-sm btn-sm btn-danger">Delete</a> 
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