<?php
session_start();
require_once 'dp.php';

if ($_SESSION['is_login'] == FALSE and $_SESSION['name'] != "Admin") {
    header("Location: index.php");
}

// echo "Hi {$_SESSION['name']} Login Successful!";
?>

