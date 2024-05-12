<?php 
    session_start();
    require_once 'dp.php';

    if ($_SESSION['is_login'] == FALSE) {
        header("Location: index.php");
    }

    if ($_SESSION['name'] == "Admin") {
        header("Location: backend.php");
    }

    if (!isset($_POST['id'])) {
        header("Location: member.php");
    }

    $id = $_POST['id'];
    $sql = "DELETE FROM `reservation` WHERE `id` = '$id'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $_SESSION['msg'] = "Delete successful!";
        header("Location: member.php");
    } else {
        $_SESSION['msg'] = "Delete failed!";
        header("Location: member.php");
    }
?>