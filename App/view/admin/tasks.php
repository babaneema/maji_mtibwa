<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// get initial data
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../../../vendor/autoload.php';

$task = new \App\Model\Task();
$database = $task->getDatabase();

$taskData = $database->query(
    "SELECT 
        employee_id, employee_name, task_id, task_unique, 
        task_employee, task_item, task_amount, task_reg_date 
    FROM Task JOIN employees ON task_employee =  employee_id"
)->fetchAll();


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
                    <h1 class="h3 mb-4 text-gray-800">Tasks</h1>

                </div>
                <!-- /.container-fluid -->
                <div class="container-fluid">
                <div class="card shadow mb-4 border-left-success ">
                    <div class="card-header py-3">
                        <?php include_once './partials/success_messages.php' ?>
                        <a href="./addTask.php" class="btn btn-primary m-0 font-weight-bold text-white">
                            Add Task
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Employee</th>
                                        <th>Item</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Employee</th>
                                        <th>Item</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                   <?php 
                                    foreach($taskData as $data) {
                                        ?>
                                        <tr>
                                            <td><?=$data['employee_name']?></td>
                                            <td><?=$data['task_item']?></td>
                                            <td><?=$data['task_amount']?></td>
                                            <td><?=$data['task_reg_date']?></td>
                                            <td>
                                                <!-- <a href="" class="btn btn-sm btn-success">Update</a> -->
                                                <a href="../../controller/admin/processDeleteTask.php?id=<?=$data['task_unique']?>" 
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete task ?');">
                                                    Delete
                                                </a>
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
