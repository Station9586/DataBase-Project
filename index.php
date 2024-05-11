<?php
session_start();
require_once 'dp.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Compiled and minified CSS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <link rel="stylesheet" href="login_style.css" media="screen">
    <!-- <style media="screen" >
        
    </style> -->

    <title>Document</title>
</head>

<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <?php if (isset($_SESSION["is_login"]) && $_SESSION["is_login"] == TRUE && isset($_SESSION['name']) && $_SESSION['name'] == "Admin") : ?>
        <?php
        session_unset();
        header('Location: backend.php');
        ?>
    <?php elseif (isset($_SESSION["is_login"]) && $_SESSION["is_login"] == TRUE) : ?>
        <?php
        session_unset();
        header('Location: member.php');
        ?>
    <?php else : ?>
        <?php if ($_SESSION['msg'] && $_SESSION['msg'] != "Register Successful!") : ?>
            <h3 id="Alert"><?php echo $_SESSION['msg']; ?></h3>
            <?php session_unset(); ?>
        <?php elseif ($_SESSION['msg'] == "Register Successful!") : ?>
            <h3 id="Success"><?php echo $_SESSION['msg']; ?></h3>
            <?php session_unset(); ?>
        <?php endif; ?>
        <form action="login.php" method="post" id="Login">
            <h3>Login Here</h3>
            <!-- <input id="username" type="text" class="validate"> -->
            <label for="">Username*</label>
            <input type="text" name="username" class="validate" id="username" require>
            <label for="">Password*</label>
            <input id="password" type="password" class="validate" name="password" require>
            <button type="submit">Login</button><br>
            <a href="/new_member.php">Register</a>
            </div>
        </form>
    <?php endif; ?>
</body>

</html>