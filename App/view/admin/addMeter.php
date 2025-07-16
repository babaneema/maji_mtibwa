<?php header("X-XSS-Protection: 0"); 
if (session_status() === PHP_SESSION_NONE) session_start();
$_SESSION['_addMeter_token'] = bin2hex(random_bytes(32));

// Get customer data. 
$id = isset($_GET['id']) ? $_GET['id'] : header('Location: ../auth/logout.php');

require_once '../../../vendor/autoload.php';
$customer = new \App\Model\Customer();
$database = $customer->getDatabase();

$data = [];

($customer->selectWhere('customer_unique', $id)) ? 
    $data = $customer->selectWhere('customer_unique', $id) : 
    $_SESSION['error'] = 'Could not get data. Please try again';

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
                    <h1 class="h3 mb-4 text-gray-800">Meter</h1>

                </div>
                <!-- /.container-fluid -->
                <div class="container-fluid">
                    <div class="card shadow mb-4 border-left-success ">
                        <div class="card-header py-3">
                            <?php include_once './partials/error_messages.php' ?>
                            <h6 class="m-0 font-weight-bold text-primary">
                                Add meter
                            </h6>
                        </div>
                        <div class="card-body">
                            <form action="../../controller/admin/processAddMeter.php" method="post">
                                <input type="hidden" name="token" value="<?=$_SESSION['_addMeter_token']?>">
                                <input type="hidden" name="cutomer_unique"  value="<?=$data[0]['customer_unique']?>" require >
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                        Customer name
                                    </label>
                                    <input 
                                        type="text" name="branch_name" class="col-lg-3 form-control" 
                                        value="<?=$data[0]['customer_name']?>" readonly
                                        >
                                </div>
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                        Customer Contact
                                    </label>
                                    <input 
                                        type="text" name="branch_name" class="col-lg-3 form-control" 
                                        value="<?=$data[0]['customer_contact']?>" readonly >
                                </div>
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                        Customer Street
                                    </label>
                                    <input 
                                        type="text" name="branch_name" class="col-lg-3 form-control" 
                                        value="<?=$data[0]['customer_address']?>" readonly  >
                                </div>
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                        Meter Owner
                                    </label>
                                    <select name="meter_owner" id="" class="col-lg-3 form-control" required>
                                        <option value="Customer">Customer</option>
                                        <option value="Organization">Organization</option>
                                        <option value="Business">Business</option>
                                    </select>
                                    
                                </div>
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                        Meter Number
                                    </label>
                                    <input type="text" name="meter_number" class="col-lg-3 form-control" required>
                                </div>
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                        Initial Unit
                                    </label>
                                    <input type="text" name="initial_units" class="col-lg-3 form-control" required>
                                </div>
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                        Joining Fee
                                    </label>
                                    <input type="text" name="joining_fees" class="col-lg-3 form-control" required>
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