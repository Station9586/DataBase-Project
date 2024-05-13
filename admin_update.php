<?php
session_start();
require_once 'dp.php';

if ($_SESSION['is_login'] == FALSE) {
    header("Location: index.php");
}

if ($_SESSION['name'] == "Admin") {
    header("Location: backend.php");
}

$account = $_SESSION['account'];

if (isset($_POST['change'])) {
    $old = $_POST['old_psw'];
    $new = $_POST['nw_password'];
    $confirm = $_POST['cf_password'];

    if ($old == "" or $new == "" or $confirm == "") {
        echo "Password is empty!";
        $_SESSION['msg'] = "Password is empty!";
        header("Location: backend.php");
    } else if ((string)$confirm != (string)$new) {
        echo "Comfirm Password is not the same!";
        $_SESSION['msg'] = "Confirm Password is not the same!";
        header("Location: backend.php");
    } else {
        $sql = "SELECT * FROM `Data` WHERE `account` = '$account' AND `password` = '$old'";
        $result = mysqli_query($con, $sql);
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $sql = "UPDATE `Data` SET `password` = '$new' WHERE `account` = '$account'";
            $result = mysqli_query($con, $sql);
            if ($result) {
                $_SESSION['msg'] = "Password changed successfully!";
                echo "Password changed successfully!";
                header("Location: backend.php");
            } else {
                $_SESSION['msg'] = "Password changed failed!";
                echo "Password changed failed!";
                header("Location: backend.php");
            }
        } else {
            $_SESSION['msg'] = "Old password is incorrect!";
            echo "Old password is incorrect!";
            header("Location: backend.php");
        }
    }
}
?>