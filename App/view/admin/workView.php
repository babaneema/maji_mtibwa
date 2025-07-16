<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// get initial data
require_once './helpers/work.php';

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
                    <h1 class="h3 mb-4 text-gray-800">Repair | Work</h1>

                </div>
                <!-- /.container-fluid -->
                <div class="container-fluid">
                <div class="card shadow mb-4 border-left-success ">
                    <div class="card-header py-3">
                        <?php include_once './partials/success_messages.php' ?>
                        <h6 class="m-0 font-weight-bold text-primary">Repair | Work Details</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-group w-50">
                            <li class="list-group-item">Tile : <?=$data[0]['work_title']?> </li>
                            <li class="list-group-item">Description :  <?=$data[0]['work_description']?></li>
                            <li class="list-group-item">Location :  <?=$data[0]['work_location']?></li>
                            <li class="list-group-item">Technicians :  <?=$data[0]['work_technicians']?></li>
                            <li class="list-group-item">Start Time :  <?=$data[0]['work_start_time']?></li>
                            <li class="list-group-item">Finish Time :  <?=$data[0]['work_finish_time'] ?></li>
                            <li class="list-group-item">Date :  <?=$data[0]['work_reg_date'] ?></li>
                            <li class="list-group-item">
                                <?php
                                    if(!$data[0]['work_finish_time']){
                                        ?>
                                         <a href="../../controller/admin/processWorkFinishTime.php?id=<?=$data[0]['work_unique'] ?>" 
                                            class="btn btn-sm btn-info">
                                            Finish
                                        </a>
                                        <?php 
                                    } 
                                ?>
                                <a href="../../controller/admin/processDeleteWork.php?id=<?=$data[0]['work_unique'] ?>" 
                                    onclick="if (!confirm('Delete work?')) return false;" 
                                    class="btn btn-sm btn-danger">
                                    Delete
                                </a>
                            </li>
                        </ul>

                        <br>
                        <hr>
                        <h6 class="m-0 font-weight-bold text-primary">Equipment Information</h6>
                        <a href="addworkEquipment.php?id=<?=$data[0]['work_unique']?>" class="btn btn-primary m-0 mt-2 mb-2 font-weight-bold text-white">
                            Add Work Equipements
                        </a> 
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Equipment</th>
                                        <th>Quantity</th>
                                        <th>Other</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Equipment</th>
                                        <th>Quantity</th>
                                        <th>Other</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                        $database->select($workEquipment->table_name, "*", 
                                        [ "work_equiment_work" => $data[0]['work_id'] ],
                                        function($data){

                                            ?>
                                            <tr>
                                                <td><?=$data['work_equiment_equipment']?></td>
                                                <td><?=$data['work_equiment_quatinty']?></td>
                                                <td><?=$data['work_equiment_other']?></td>
                                            </tr>
                                            <?php 
                                        }); 
                                    ?>
                                </tbody>
                            </table>
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

