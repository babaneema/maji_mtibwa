<?php header("X-XSS-Protection: 0"); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) session_start();
$_SESSION['_addWork_token'] = bin2hex(random_bytes(32));
require_once '../../../vendor/autoload.php';

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
                    <h1 class="h3 mb-4 text-gray-800">Repair | Work Information </h1>

                </div>
                <!-- /.container-fluid -->
                <div class="container-fluid">
                    <div class="card shadow mb-4 border-left-success ">
                        <div class="card-header py-3">
                            <?php include_once './partials/error_messages.php' ?>
                            <h6 class="m-0 font-weight-bold text-primary">
                                Repair | Work Information 
                            </h6>
                        </div>
                        <div class="card-body">
                            <form action="../../controller/admin/processAddWork.php" method="post">
                                <input type="hidden" name="token" value="<?=$_SESSION['_addWork_token']?>">
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                        Work
                                    </label>
                                    <select name="name" class="col-lg-3 form-control" required>
                                        <option value="New Connection">New Connection</option>
                                        <option value="Repair">Repair</option>
                                        <option value="Stop service">Stop service</option>
                                        <option value="Return service">Return service</option>
                                        <option value="Other work">Other work</option>
                                    </select>
                                </div>
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                        Discription
                                    </label>
                                    <textarea name="description" cols="30" rows="7" class="col-lg-3 form-control" required></textarea>
                                </div>
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                        Location
                                    </label>
                                    <input type="text" name="location" class="col-lg-3 form-control" required>
                                </div>
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                        Technician
                                    </label>
                                    <select name="technicians[]" class="col-lg-3 form-control" multiple>
                                        <?php 
                                            $database->select($employee->table_name, "*", 
                                            function($data){
                                                ?>
                                                <option value="<?=$data['employee_name']?>">
                                                    <?=$data['employee_name']?>
                                                </option>
                                                <?php 
                                            });
                                        ?>
                                    </select>
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