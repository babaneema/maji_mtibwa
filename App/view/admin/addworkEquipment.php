<?php header("X-XSS-Protection: 0"); 
if (session_status() === PHP_SESSION_NONE) session_start();
$_SESSION['_addWorkEquipment_token'] = bin2hex(random_bytes(32));

require_once '../../../vendor/autoload.php';

$id = isset($_GET['id']) ? $_GET['id'] : header('Location: ../auth/logout.php');

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
                    <h1 class="h3 mb-4 text-gray-800"> Repair | Work </h1>

                </div>
                <!-- /.container-fluid -->
                <div class="container-fluid">
                    <div class="card shadow mb-4 border-left-success ">
                        <div class="card-header py-3">
                            <?php include_once './partials/error_messages.php' ?>
                            <h6 class="m-0 font-weight-bold text-primary">
                            Repair | Work Equipments
                            </h6>
                        </div>
                        <div class="card-body">
                            <form action="../../controller/admin/processAddWorkEquipment.php" method="post">
                                <input type="hidden" name="token" value="<?=$_SESSION['_addWorkEquipment_token']?>">
                                <input type="hidden" name="work_id" value="<?=$id?>">
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                        Equipment
                                    </label>
                                    <select name="equipment" id=""  class="col-lg-3 form-control">
                                        <option value="">------Select------</option>
                                        <?php
                                            $database->select($equipment->table_name, "*", function($data){
                                                ?>
                                                <option value="<?=$data['equipment_id']?>">
                                                    <?=$data['equipment_name']?> | <?=$data['equipment_type']?> |
                                                    <?=$data['equipment_company']?>
                                                </option>
                                                <?php 
                                            }); 
                                        ?>
                                    </select>
                                </div>
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                       Quantity
                                    </label>
                                    <input type="text" name="quantity" class="col-lg-3 form-control" required>
                                </div>
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                       Other Equipment
                                    </label>
                                    <input type="text" name="other" class="col-lg-3 form-control" >
                                </div>
                                <div class="row">
                                    <button type="submit" class="btn btn-success btn-block col-lg-3 offset-lg-2">Save</button>
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