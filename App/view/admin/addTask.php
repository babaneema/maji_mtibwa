<?php header("X-XSS-Protection: 0"); 
if (session_status() === PHP_SESSION_NONE) session_start();
$_SESSION['_addTask_token'] = bin2hex(random_bytes(32));

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
                    <h1 class="h3 mb-4 text-gray-800">Task</h1>

                </div>
                <!-- /.container-fluid -->
                <div class="container-fluid">
                    <div class="card shadow mb-4 border-left-success ">
                        <div class="card-header py-3">
                            <?php include_once './partials/error_messages.php' ?>
                            <h6 class="m-0 font-weight-bold text-primary">
                                Add Task
                            </h6>
                        </div>
                        <div class="card-body">
                            <form action="../../controller/admin/processAddTask.php" method="post">
                                <input type="hidden" name="token" value="<?=$_SESSION['_addTask_token']?>">
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                        Employee name
                                    </label>
                                    <select name="task_employee" class="col-lg-3 form-control" required>
                                        <?php
                                            $database->select($employee->table_name, $employee->field, function ($data){
                                                ?>
                                                    <option value="<?=$data['employee_id']?>"><?=$data['employee_name']?></option>
                                                <?php 
                                            }); 
                                        ?>
                                    </select>
                                </div>
                                <div class="row form-group">
                                    <label for="contact" class="col-lg-2 form-control-label">
                                        Task Item    
                                    </label>
                                    <input type="text" name="task_item" class="col-lg-3 form-control" required>
                                </div>
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                        Task Amount (Tsh) 
                                    </label>
                                    <input name="task_amount" type="number" step="0.01" min="0" placeholder="Enter a number" class="col-lg-3 form-control" required>
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