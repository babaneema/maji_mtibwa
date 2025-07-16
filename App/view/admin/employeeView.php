<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// get initial data
require_once './helpers/employee.php';
$_SESSION['_filterPayroll_token'] = bin2hex(random_bytes(32));

$emp_uniqu = $data[0]['employee_unique'];

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
                    <h1 class="h3 mb-4 text-gray-800">Employee</h1>

                </div>
                <!-- /.container-fluid -->
                <div class="container-fluid">
                <div class="card shadow mb-4 border-left-success ">
                    <div class="card-header py-3">
                        <?php include_once './partials/success_messages.php' ?>
                        <h6 class="m-0 font-weight-bold text-primary">EMployee Details</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-group w-50">
                            <li class="list-group-item">Name : <?=$data[0]['employee_name']?> </li>
                            <li class="list-group-item">Gender :  <?=$data[0]['employee_gender']?></li>
                            <li class="list-group-item">Contact :  <?=$data[0]['employee_contact']?></li>
                            <li class="list-group-item">Address :  <?=$data[0]['employee_address']?></li>
                            <li class="list-group-item">Branch :  <?=$data[0]['branch_name']?></li>
                            <li class="list-group-item">Department : <?=$data[0]['employee_department']?> </li>
                            <li class="list-group-item">Authority : <?=$data[0]['employee_authority']?></li>
                            <li class="list-group-item">Date : <?=$data[0]['employee_reg_date']?></li>
                            <li>
                                <a href="updateEmployee.php?id=<?=$data[0]['employee_unique']?>" class="btn btn-sm btn-success">
                                    Update
                                </a>
                                <a href="../../controller/admin/processDeleteEmployee.php?id=<?=$data[0]['employee_unique']?>" 
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete employee ?');">
                                    Delete
                                </a>
                            </li>
                        </ul>

                        <br>
                        <hr>
                        <h4 class="m-0 font-weight-bold text-primary text-center">
                            Payroll Filter
                        </h4>
                        <br>
                        <form action="../../controller/admin/processFilterEmployeePayrol.php" method="post">
                            <input type="hidden" name="token" value="<?=$_SESSION['_filterPayroll_token']?>">
                            <input type="hidden" name="employee_id" value="<?=$data[0]['employee_id']?>">
                            <div class="row form-group">
                                <label for="Name" class="col-lg-2 form-control-label">
                                    Start Date
                                </label>
                                <input name="start_date" type="date" class="col-lg-3 form-control" required>
                            </div>
                            <div class="row form-group">
                                <label for="Name" class="col-lg-2 form-control-label">
                                    End Date
                                </label>
                                <input name="end_date" type="date" class="col-lg-3 form-control" required>
                            </div>
                            <div class="row">
                                <button type="submit" class="btn btn-success btn-block col-lg-3 offset-lg-2">Search</button>
                            </div>
                        </form>
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