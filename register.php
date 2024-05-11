<?php
session_start();
require_once 'dp.php';

$name = "CAT";
$username = $_POST['username'];
$password = $_POST['password'];
$password_again = $_POST['password_again'];

if (empty($name) or empty($username) or empty($password)) {
    echo "Name, username or password is empty!";
    header("Location: new_member.php");
}

if ($password != $password_again) {
    // echo "Password is not the same!";
    // echo '<script>alert("Password is not the same!")</script>';
    $_SESSION['msg'] = "Password is not the same!";
    // session_unset();
    header("Location: new_member.php");
    exit();
}


$sql = "SELECT * FROM Data WHERE account = '$username'";
$result = mysqli_query($con, $sql);
$rows = mysqli_num_rows($result);

if ($rows == 1) {
    $_SESSION['msg'] = "Username already exists!";
    // echo "Username already exists!";
    header("Location: new_member.php");
} else {
    $sql = "INSERT INTO Data (name, account, password) VALUES ('$name', '$username', '$password')";
    $result = mysqli_query($con, $sql);
    if ($result) {
        echo "Register Successful!";
        $_SESSION['msg'] = "Register Successful!";
        header("Location: index.php");
    } else {
        echo "Register Failed!";
        $_SESSION['msg'] = "Register Failed!";
        header("Location: new_member.php");
    }
}
?>