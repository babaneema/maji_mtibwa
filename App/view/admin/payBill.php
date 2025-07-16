<?php header("X-XSS-Protection: 0"); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) session_start();
$_SESSION['_payBill_token'] = bin2hex(random_bytes(32));

require_once '../../../vendor/autoload.php';
$id = isset($_GET['id']) ? $_GET['id'] : header('Location: ../auth/logout.php');

$bill = new \App\Model\Bill();
$database = $bill->getDatabase();

$cudata = $database->select(
    $bill->table_name, 
    [
        "[>]customer" => ["bill_customer" => "customer_id"]
    ],
    [
        "bill_unit_used", "bill_cost", "bill_reg_date", "customer_name", "bill_id"
    ],
    [
        "bill_unique" => $id
    ]
);


$paid = $database->sum('payments', "pay_amount", [
    "pay_bill" => $cudata[0]['bill_id']
]);

if(empty($paid)) $paid = 0;
$debt = $cudata[0]['bill_cost'] - $paid;


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
                    <h1 class="h3 mb-4 text-gray-800">Customer</h1>

                </div>
                <!-- /.container-fluid -->
                <div class="container-fluid">
                    <div class="card shadow mb-4 border-left-success ">
                        <div class="card-header py-3">
                            <?php include_once './partials/error_messages.php' ?>
                            <h6 class="m-0 font-weight-bold text-primary">
                                Pay Customer Bill 
                            </h6>
                        </div>
                        <div class="card-body">
                            <form action="../../controller/admin/processPayBill.php" method="post">
                                <input type="hidden" name="token" value="<?=$_SESSION['_payBill_token']?>">
                                <input type="hidden" name="unique" value="<?=$id ?>">
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                        Customer Name
                                    </label>
                                    <input type="text" value="<?=$cudata[0]['customer_name']?>" readonly class="col-lg-3 form-control" >
                                </div>
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                       Bill Date
                                    </label>
                                    <input type="text" value="<?=$cudata[0]['bill_reg_date']?>" readonly class="col-lg-3 form-control" >   
                                </div>
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                       Bill Amount
                                    </label>
                                    <input type="text" value="<?=$cudata[0]['bill_cost']?>" readonly class="col-lg-3 form-control" >   
                                </div>
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                       Paid Amount 
                                    </label>
                                    <input type="text"  value="<?=$paid?>" readonly class="col-lg-3 form-control" >   
                                </div>
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                       Debt
                                    </label>
                                    <input type="text" value="<?=$debt?>" readonly class="col-lg-3 form-control">   
                                </div>
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                        Paying Amount
                                    </label>
                                    <input type="number" name="amount"
                                        max="<?=$debt?>"
                                        class="col-lg-3 form-control" required placeholder="Max payment : <?=$debt?> ">   
                                </div>
                                <div class="row form-group">
                                    <label for="Name" class="col-lg-2 form-control-label">
                                        Payment Method
                                    </label>
                                    <select name="method" require class="col-lg-3 form-control">
                                        <option value="Bank">Bank</option>
                                        <option value="Mobile">Mobile</option>
                                        <option value="Cash">Cash</option>
                                    </select>   
                                </div>
                                <div class="row">
                                    <button type="submit" class="btn btn-success btn-block col-lg-3 offset-lg-2">Pay</button>
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