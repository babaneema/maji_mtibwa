<?php
if (session_status() === PHP_SESSION_NONE) session_start();

$autority = isset($_SESSION['authority']) 
            ? $_SESSION['authority'] : 
            header('Location: ../auth/logout.php');


?>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><?=SIDEBAR_TITLE?></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <?php
    if($autority == "Admin"){
        ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link" href="branch.php">
                    <i class="fas fa-fw  fa-code-branch"></i>
                    <span>Branchs</span> 
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="unit.php">
                    <i class="fas fa-fw  fa-code-branch"></i>
                    <span>Unit</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="employees.php">
                    <i class="fa-regular fa-address-card"></i>
                    <span>Employees</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Technical
            </div>
            <li class="nav-item">
                <a class="nav-link" href="customer.php"">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Customers</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./sms.php">
                    <i class="fa-regular fa-envelope"></i>
                    <span>Messages</span>
                </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Finance
            </div>

            <li class="nav-item">
                <a class="nav-link" href="bills.php">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                    <span>Bills</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="tasks.php">
                    <i class="fa-solid fa-list-check"></i>
                    <span>Tasks</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="payroll.php">
                    <i class="fa-solid fa-money-check-dollar"></i>
                    <span>Payroll</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="report.php">
                    <i class="fa-solid fa-money-check-dollar"></i>
                    <span>Report</span>
                </a>
            </li>
        <?php
    } 
    if($autority == "Admin" || $autority == "Normal"){
        ?>
            <li class="nav-item">
                <a class="nav-link" href="meter.php">
                    <i class="fa-solid fa-gauge-high"></i>
                    <span>Meter</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="bills_tech.php">
                    <i class="fa-solid fa-gauge-high"></i>
                    <span>Bills - Tech</span>
                </a>
            </li>
        <?php
    }
    ?>
    

    <li class="nav-item">
        <a class="nav-link" href="../auth/login.php">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <span>Logout</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>