<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header("X-XSS-Protection: 0"); 
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../../../vendor/autoload.php';

$expenditure = new \App\Model\Expenditure();
$database = $expenditure->getDatabase();

$id = isset($_GET['id']) ? $_GET['id'] : header('Location: ../auth/logout.php');

$data = $database->select($expenditure->table_name, "*", 
[
    "expenditure_unique" => $id
]);

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
                    <h1 class="h3 mb-4 text-gray-800">Expenditure</h1>

                </div>
                <!-- /.container-fluid -->
                <div class="container-fluid">
                <div class="card shadow mb-4 border-left-success ">
                    <div class="card-header py-3">
                        <?php include_once './partials/success_messages.php' ?>
                        <h6 class="m-0 font-weight-bold text-primary">Expenditure Details</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-group w-50">
                            <li class="list-group-item">Title : <?=$data[0]['expenditure_title']?> </li>
                            <li class="list-group-item">Description :  <?=$data[0]['expenditure_description']?></li>
                            <li class="list-group-item">Number of Items :  <?=$data[0]['expenditure_items_number']?></li>
                            <li class="list-group-item">Cost / Item :  <?=$data[0]['expenditure_item_cost']?></li>
                            <li class="list-group-item">Total Cost :  <?=$data[0]['expenditure_amount']?></li>
                            <li class="list-group-item">Supplier :  <?=$data[0]['expenditure_supplier_name']?></li>
                            <li class="list-group-item">Supplier Contact :  <?=$data[0]['expenditure_supplier_contact']?></li>
                            <li class="list-group-item">Authorized by :  <?=$data[0]['expenditure_authorized']?></li>
                            <li class="list-group-item">Date :  <?=$data[0]['expenditure_reg_date']?></li>
                            <li class="list-group-item">
                                <a href="" class="btn btn-sm btn-success">Update</a>
                                <a href="" class="btn btn-sm btn-danger">Delete</a>
                            </li>
                        </ul>

                        <br>
                        <hr>
                       
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

