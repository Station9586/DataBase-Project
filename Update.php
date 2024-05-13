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
    if (empty($old) or empty($new) or empty($confirm)) {
        echo "Password is empty!";
        $_SESSION['msg'] = "Password is empty!";
        header("Location: member.php");
    } else if ($confirm != $new){
        echo "Comfirm Password is not the same!";
        $_SESSION['msg'] = "Confirm Password is not the same!";
        header("Location: member.php");
    }else {
        $sql = "SELECT * FROM `Data` WHERE `account` = '$account' AND `password` = '$old'";
        $result = mysqli_query($con, $sql);
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $sql = "UPDATE `Data` SET `password` = '$new' WHERE `account` = '$account'";
            $result = mysqli_query($con, $sql);
            if ($result) {
                $_SESSION['msg'] = "Password changed successfully!";
                echo "Password changed successfully!";
                header("Location: member.php");
            } else {
                $_SESSION['msg'] = "Password changed failed!";
                echo "Password changed failed!";
                header("Location: member.php");
            }
        } else {
            $_SESSION['msg'] = "Old password is incorrect!";
            echo "Old password is incorrect!";
            header("Location: member.php");
        }
    }
}

if (isset($_POST['delete'])) {
    $password = $_POST['old_psw'];
    $sql = "SELECT * FROM `Data` WHERE `account` = '$account'";
    $result = mysqli_query($con, $sql);
    $cmp = mysqli_fetch_assoc($result)["password"];
    if (empty($password)) {
        echo "Password is empty!";
        $_SESSION['msg'] = "Password is empty!";
        header("Location: member.php");
    }else if ($password != $cmp) {
        echo "Password is incorrect!";
        $_SESSION['msg'] = "Password is incorrect!";
        header("Location: member.php");
    }else {
        $sql = "DELETE FROM `Data` WHERE `account` = '$account'";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $_SESSION['msg'] = "Account deleted successfully!";
            echo "Account deleted successfully!";
            header("Location: index.php");
        } else {
            $_SESSION['msg'] = "Account deleted failed!";
            echo "Account deleted failed!";
            header("Location: member.php");
        }
    }

    
}

?>

