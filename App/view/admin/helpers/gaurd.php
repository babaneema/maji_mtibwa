<?php 
if (session_status() === PHP_SESSION_NONE) session_start();
$autority = isset($_SESSION['authority']) 
    ? $_SESSION['authority'] 
    :  header('Location: ../auth/logout.php');

if($autority != "Admin") header('Location: ./meter.php');