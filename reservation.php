<?php
    session_start();
    require_once 'dp.php';
    function randomID () {
        $id = "";
        for ($i = 0; $i < 10; $i ++) {
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

    if (isset($_POST['reserve'])) {
        $account = $_SESSION['account'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $people = $_POST['people'];
        $space = $_POST['space'];

        if (empty($date) or empty($time) or empty($people) or empty($space)) {
            $_SESSION['msg'] = "Please fill in all the information!";
            header("Location: member.php");
        }

        $sql = "SELECT * FROM `reservation` WHERE `date` = '$date' AND `time` = '$time' AND `room` = '$space'";
        $result = mysqli_query($con, $sql);
        $rows = mysqli_num_rows($result);
        if ($rows >= 1) {
            $_SESSION['msg'] = "The space has been reserved!";
            header("Location: member.php");
        }else {
            $sql = "SELECT * FROM `reservation` WHERE `account` = '$account' AND `date` = '$date' AND `time` = '$time'";
            $result = mysqli_query($con, $sql);
            $rows = mysqli_num_rows($result);
            if ($rows == 1) {
                $_SESSION['msg'] = "You have already reserved this time!";
                header("Location: member.php");
            } else {
                $id = randomID();
                $sql = "INSERT INTO `reservation`(`account`, `date`, `time`, `people`, `room`, `id`) VALUES ('$account', '$date', '$time', '$people', '$space', '$id')";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    $_SESSION['msg'] = "Reservation successful!";
                    header("Location: member.php");
                } else {
                    $_SESSION['msg'] = "Reservation failed!";
                    header("Location: member.php");
                }
            }
        }
    }

    if (isset($_POST['update'])) {
        $old_id = $_POST['old_id'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $people = $_POST['people'];
        $space = $_POST['space'];

        if (empty($old_id) or empty($date) or empty($time) or empty($people) or empty($space)) {
            $_SESSION['msg'] = "Please fill in all the information!";
            header("Location: member.php");
        }

        $account = $_SESSION['account'];
        $sql = "SELECT * FROM `reservation` WHERE `id` = '$old_id'";
        $result = mysqli_query($con, $sql);
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            // if reservation already been reserved
            $sql = "SELECT * FROM `reservation` WHERE `date` = '$date' AND `time` = '$time' AND `room` = '$space'";
            $result = mysqli_query($con, $sql);
            $rows = mysqli_num_rows($result);
            if ($rows >= 1) {
                $_SESSION['msg'] = "The space has been reserved!";
                header("Location: member.php");
            }else {
            // if reservation is not reserved
                $sql = "SELECT * FROM `reservation` WHERE `account` = '$account' AND `date` = '$date' AND `time` = '$time'";
                $result = mysqli_query($con, $sql);
                $rows = mysqli_num_rows($result);
                if ($rows == 1) {
                    $_SESSION['msg'] = "You have already reserved this time!";
                    header("Location: member.php");
                } else {       
                    $sql = "UPDATE `reservation` SET `date` = '$date', `time` = '$time', `people` = '$people', `room` = '$space' WHERE `id` = '$old_id'";
                    $result = mysqli_query($con, $sql);
                    if ($result) {
                        $_SESSION['msg'] = "Update successful!";
                        header("Location: member.php");
                    } else {
                        $_SESSION['msg'] = "Update failed!";
                        header("Location: member.php");
                    }
                }
            }
        } else {
            $_SESSION['msg'] = "Reservation not found!";
            header("Location: member.php");
        }
    }

?>