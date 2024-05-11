<?php
$host = "127.0.0.1";
$user = "root";
$password = "";
$db_name = "Account";

$con = mysqli_connect($host, $user, $password, $db_name);

if ($con) mysqli_query($con, "SET NAMES 'utf8'");
else echo "Failed to connect to MySQL: <br/>" . mysqli_connect_error();
?>
