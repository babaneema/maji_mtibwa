<?php header("X-XSS-Protection: 0"); 
require_once './helpers/updateEmployee.php';

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
                            <?php include_once './partials/error_messages.php' ?>
                            <h6 class="m-0 font-weight-bold text-primary">
                                Update Employee
                            </h6>
                        </div>
                        <div class="card-body">
                            <form action="../../controller/admin/processUpdateEmployee.php" method="post">
                                <input type="hidden" name="token" value="<?=$_SESSION['_updateEmployee_token']?>">
                                <input type="hidden" name="id" value="<?=$data[0]['employee_id']?>">
                                <input type="hidden" name="unique" value="<?=$data[0]['employee_unique']?>">
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                        Branch name
                                    </label>
                                    <select name="branch_id" class="col-lg-3 form-control" required>
                                        <?php
                                            $database->select($branch->table_name, $branch->field, function ($data){
                                                ?>
                                                    <option value="<?=$data['branch_id']?>"><?=$data['branch_name']?></option>
                                                <?php 
                                            }); 
                                        ?>
                                    </select>
                                </div>
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                    Employee name
                                    </label>
                                    <input type="text" name="name" value="<?=$data[0]["employee_name"]?>" class="col-lg-3 form-control" required>
                                </div>
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                        Employee Gender
                                    </label>
                                    <select name="gender" class="col-lg-3 form-control" required>
                                       <option value="Male">Male</option>
                                       <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="row form-group">
                                    <label for="contact" class="col-lg-2 form-control-label">
                                        Employee Contact    
                                    </label>
                                    <input type="text" value="<?=$data[0]['employee_contact']?>" name="contact" class="col-lg-3 form-control" required>
                                </div>
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                        Employee Address
                                    </label>
                                    <input type="text" value="<?=$data[0]['employee_address']?>" name="address" class="col-lg-3 form-control" required>
                                </div>
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                        Department
                                    </label>
                                    <select name="department" class="col-lg-3 form-control" required>
                                        <option value="Technical" selected>Technical</option>
                                        <option value="Administration">Administration</option>
                                    </select>
                                </div>
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                        Authorization
                                    </label>
                                    <select name="authority" class="col-lg-3 form-control" required>
                                        <option value="Normal">Normal</option>
                                        <option value="Admin">Admin</option>
                                    </select>
                                </div>
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                        Employee password
                                    </label>
                                    <input type="password" name="password" class="col-lg-3 form-control" required>
                                </div>
                                <div class="row">
                                    <button type="submit" class="btn btn-success btn-block col-lg-3 offset-lg-2">Update</button>
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