<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (session_status() === PHP_SESSION_NONE) session_start();
header('Location: App/view/auth/login.php');
?>
<!-- <h1>Testing</h1> -->

