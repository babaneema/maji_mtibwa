<?php header("X-XSS-Protection: 0"); 
if (session_status() === PHP_SESSION_NONE) session_start();
$_SESSION['_login_token'] = bin2hex(random_bytes(32));

?>
<!DOCTYPE html>
<html lang="en">
<?php require_once '../links.php'; ?>
<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" action="../../controller/auth/processLogin.php" method="post">
                                        <input type="hidden" name="token" value="<?=$_SESSION['_login_token']?>">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                name="phonenumber" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                name="password" placeholder="Password">
                                        </div>
                                  
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <?php require_once '../scripts.php' ?>
</body>

</html>