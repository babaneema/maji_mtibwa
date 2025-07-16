<?php header("X-XSS-Protection: 0"); 
require_once './helpers/updateAddress.php'
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
                    <h1 class="h3 mb-4 text-gray-800">Address</h1>

                </div>
                <!-- /.container-fluid -->
                <div class="container-fluid">
                    <div class="card shadow mb-4 border-left-success ">
                        <div class="card-header py-3">
                            <?php include_once './partials/error_messages.php' ?>
                            <h6 class="m-0 font-weight-bold text-primary">
                                Update Address
                            </h6>
                        </div>
                        <div class="card-body">
                            <form action="../../controller/admin/processUpdateAddress.php" method="post">
                                <input type="hidden" name="token" value="<?=$_SESSION['_update_token']?>">
                                <input type="hidden" name="address_id" value="<?=$data[0]['address_id']?>">
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                        Address name
                                    </label>
                                    <input type="text" 
                                        name="address_name" class="col-lg-3 form-control" 
                                        value="<?=$data[0]['address_name']?>" required>
                                </div>
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
                                <div class="row">
                                    <button type="submit" class="btn btn-warning btn-block col-lg-3 offset-lg-2">Update</button>
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