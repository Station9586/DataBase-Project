<?php 
    session_start();
    require_once 'dp.php';
    function randomID () {
        $id = "";
        for ($i = 0; $i < 10; $i++) {
            $char_or_num = rand(0, 1);
            if ($char_or_num == 0) {
                $id .= chr(rand(65, 90));
            } else {
                $id .= rand(0, 9);
            }
        }
        return $id;
    }

    if ($_SESSION['is_login'] == FALSE) {
        header("Location: index.php");
    }

    if ($_SESSION['name'] == "Admin") {
        header("Location: backend.php");
    }

    if (isset($_POST['ismodify']) and $_POST['ismodify'] and $_POST['account'] != "user") {
        $password = $_POST['password'];
        $account = $_POST['account'];
        $sql = "UPDATE `Data` SET `password` = '$password' WHERE `account` = '$account'";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $_SESSION['msg'] = "Password changed successfully!";
            header("Location: backend.php");
        } else {
            $_SESSION['msg'] = "Password changed failed!";
            header("Location: backend.php");
        }
    }
    // modify user password in admin page
    if (isset($_POST['isdel']) and $_POST['isdel'] and $_POST['account'] != "user") {
        $account = $_POST['account'];
        $sql = "DELETE FROM `Data` WHERE `account` = '$account'";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $_SESSION['msg'] = "Delete successful!";
            header("Location: backend.php");
        } else {
            $_SESSION['msg'] = "Delete failed!";
            header("Location: backend.php");
        }
    }

    if (isset($_POST['isinsert']) and $_POST['isinsert'] and $_POST['account'] != "user") {
        $account = $_POST['account'];
        $password = $_POST['password'];
        $sql = "INSERT INTO `Data`(`name`, `account`, `password`) VALUES ('CAT', '$account', '$password')";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $_SESSION['msg'] = "Insert successful!";
            header("Location: backend.php");
        } else {
            $_SESSION['msg'] = "Insert failed!";
            header("Location: backend.php");
        }
    }

    if (isset($_POST['res_isinsert']) and $_POST['res_isinsert']) {
        $account = $_POST['account'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $people = $_POST['people'];
        $space = $_POST['space'];

        if (empty($date) or empty($time) or empty($people) or empty($space)) {
            $_SESSION['msg'] = "Please fill in all the information!";
            header("Location: backend.php");
        }

        $sql = "SELECT * FROM `reservation` WHERE `date` = '$date' AND `time` = '$time' AND `room` = '$space'";
        $result = mysqli_query($con, $sql);
        $rows = mysqli_num_rows($result);
        if ($rows >= 1) {
            $_SESSION['msg'] = "The space has been reserved!";
            header("Location: backend.php");
        }else {
            $sql = "SELECT * FROM `reservation` WHERE `account` = '$account' AND `date` = '$date' AND `time` = '$time'";
            $result = mysqli_query($con, $sql);
            $rows = mysqli_num_rows($result);
            if ($rows == 1) {
                $_SESSION['msg'] = "You have already reserved this time!";
                header("Location: backend.php");
            }else {
                $sql = "SELECT * FROM `Data` WHERE `account` = '$account'";
                $result = mysqli_query($con, $sql);
                $rows = mysqli_num_rows($result);
                if ($rows == 0) {
                    $_SESSION['msg'] = "Account not found!";
                    header("Location: backend.php");
                } else {
                    $id = randomID();
                    $sql = "INSERT INTO `reservation`(`account`, `date`, `time`, `people`, `room`, `id`) VALUES ('$account', '$date', '$time', '$people', '$space', '$id')";
                    $result = mysqli_query($con, $sql);
                    if ($result) {
                        $_SESSION['msg'] = "Reservation successful!";
                        header("Location: backend.php");
                    } else {
                        $_SESSION['msg'] = "Reservation failed!";
                        header("Location: backend.php");
                    }
                }
            }
        }
    }

    if (isset($_POST['res_ismodify']) and $_POST['res_ismodify']) {
        $old_id = $_POST['old_id'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $people = $_POST['people'];
        $space = $_POST['space'];

        if (empty($old_id) or empty($date) or empty($time) or empty($people) or empty($space)) {
            $_SESSION['msg'] = "Please fill in all the information!";
            header("Location: backend.php");
        }

        // $account = $_SESSION['account'];
        $sql = "SELECT * FROM `reservation` WHERE `id` = '$old_id'";
        $result = mysqli_query($con, $sql);
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $sql = "UPDATE `reservation` SET `date` = '$date', `time` = '$time', `people` = '$people', `room` = '$space' WHERE `id` = '$old_id'";
            $result = mysqli_query($con, $sql);
            if ($result) {
                $_SESSION['msg'] = "Update successful!";
                header("Location: backend.php");
            } else {
                $_SESSION['msg'] = "Update failed!";
                header("Location: backend.php");
            }
        } else {
            $_SESSION['msg'] = "ID not found!";
            header("Location: backend.php");
        }
    }

    if (isset($_POST['res_isdel']) and $_POST['res_isdel']) {
        $id = $_POST['old_id'];
        $sql = "DELETE FROM `reservation` WHERE `id` = '$id'";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $_SESSION['msg'] = "Delete successful!";
            header("Location: backend.php");
        } else {
            $_SESSION['msg'] = "Delete failed!";
            header("Location: backend.php");
        }
    }
?>