<?php
    session_start();
    require_once 'dp.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) or empty($password)) {
        echo "Username or password is empty!";
        header("Location: index.php");
    }

    $sql = "SELECT * FROM Data WHERE account = '$username' AND password = '$password'";

    $result = mysqli_query($con, $sql);
    $rows = mysqli_num_rows($result);

    if ($rows == 1) {
        $_SESSION['is_login'] = TRUE;
        $people = mysqli_fetch_assoc($result);
        $_SESSION['name'] = $people['name'];
        $_SESSION['account'] = $people['account'];
        if ($_SESSION['name'] == "Admin")
            header("Location: backend.php");
        else {
            // echo "Hi {$_SESSION['name']} Login Successful!";
            header("Location: member.php");
        }
    } else {
        $_SESSION['is_login'] = FALSE;
        $_SESSION['msg'] = "Username or password is incorrect!";
        echo "Username or password is incorrect!";
        header("Location: index.php");
    }
?>
