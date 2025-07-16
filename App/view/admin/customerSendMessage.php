<?php header("X-XSS-Protection: 0"); 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// get initial data

if (session_status() === PHP_SESSION_NONE) session_start();
$_SESSION['_SendSingleCustomerSms_token'] = bin2hex(random_bytes(32));
require_once '../../../vendor/autoload.php';


$customer = new \App\Model\Customer();
$database = $customer->getDatabase();

$id = isset($_GET['id']) ? $_GET['id'] : header('Location: ../auth/logout.php');
$data = $database->select($customer->table_name, 
            [
                "[>]branch" => ["customer_branch" => "branch_id"]
            ], 
            [
                "branch_name", "customer_id", "customer_unique", 
                "customer_name", "customer_gender", "customer_contact", "customer_house_number",
                "customer_reg_date", "customer_address"
            ],
            [
                "customer_unique" => $id
            ]
        );

$cust_uniqu = $data[0]['customer_unique'];
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
                    <h1 class="h3 mb-4 text-gray-800">Customer SMS</h1>

                </div>
                <!-- /.container-fluid -->
                <div class="container-fluid">
                <div class="card shadow mb-4 border-left-success ">
                    <div class="card-header py-3">
                        <?php include_once './partials/success_messages.php' ?>
                        <h6 class="m-0 font-weight-bold text-primary">Customer Details</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-group w-50">
                            <li class="list-group-item">Name : <?=$data[0]['customer_name']?> </li>
                            <li class="list-group-item">Gender :  <?=$data[0]['customer_gender']?></li>
                            <li class="list-group-item">Contact :  <?=$data[0]['customer_contact']?></li>
                            <li class="list-group-item">Address :  <?=$data[0]['customer_address']?></li>
                            <li class="list-group-item">Branch :  <?=$data[0]['branch_name']?></li>
                            <li class="list-group-item">Unit Price : <?=$data[0]['branch_name']?> </li>
                            <li class="list-group-item">House Number : <?=$data[0]['customer_house_number']?></li>    
                        </ul>
                        <br>
                        <hr>
                        <form action="../../controller/admin/processSebdSingleCustomerSms.php" method="post">
                            <input type="hidden" name="token" value="<?=$_SESSION['_SendSingleCustomerSms_token']?>">
                            <input type="hidden" name="customer_uuid" value="<?=$cust_uniqu?>">
                            <input type="hidden" name="customer_contact" value="<?=$data[0]['customer_contact']?>">
                            <div class="row form-group">
                                <label for="Name" class="col-lg-2 form-control-label">
                                    Message
                                </label>
                                <textarea name="message" id="" class="col-lg-3 form-control" required></textarea>
                            </div>
                            <div class="row">
                                <button type="submit" class="btn btn-success btn-block col-lg-3 offset-lg-2">
                                    Send Message
                                </button>
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