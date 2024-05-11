<?php
session_start();
require_once 'dp.php';

if ($_SESSION['is_login'] == FALSE) {
    header("Location: index.php");
}

if ($_SESSION['name'] == "Admin") {
    header("Location: backend.php");
}
// echo "Hi {$_SESSION['name']} Login Successful!";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="SideNavigationMenu.css">
    <link rel="stylesheet" href="content.css">
    <link rel="stylesheet" href="member_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>圖書館空間預約系統</title>
</head>

<body>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <?php
        if (isset($_SESSION['msg'])) {
            echo "<script>alert('{$_SESSION['msg']}')</script>";
            unset($_SESSION['msg']);
        }
    ?>
    <div class="navigation">
        <div class="menuToggle"></div>
        <ul>
            <li class="list active" style="--clr:#f44336;">
                <a href="#" id="HomePage">
                    <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                    <span class="text">Home</span>
                </a>
            </li>
            <li class="list" style="--clr:#ffa117;">
                <a href="#" id="DATA">
                    <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                    <span class="text">已預約資訊</span>
                </a>
            </li>
            <li class="list" style="--clr:#0fc70f;">
                <a href="#" id="GoR">
                    <span class="icon"><ion-icon name="chatbubble-outline"></ion-icon></span>
                    <span class="text">前往預約！</span>
                </a>
            </li>
            <li class="list" style="--clr:#2196f3;">
                <a href="#" id="DeleteR">
                    <span class="icon"><ion-icon name="camera-outline"></ion-icon></span>
                    <span class="text">刪除預約！</span>
                </a>
            </li>
            <li class="list" style="--clr:#b145e9;">
                <a href="#" id="Logout">
                    <span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
                    <span class="text">Setting</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="content show" id="pg1">
        <h1>圖書館空間預約系統</h1>
        <h2>Hi, <?php echo $_SESSION['account']; ?> Welcome!</h2>
        <p>這是一個圖書館空間預約系統，您可以在這裡預約圖書館的空間，並且查看您的預約資訊。</p>
        <img src="img/homepage.png" width="667" height="500" id="img1">
    </div>

    <div class="content" id="pg3">
        <h1>前往預約！</h1>
        <form action="reservation.php" method="post">
            <label for="date">預約日期：</label>
            <input type="date" id="date" name="date" required>
            <label for="time">預約時間：</label>
            <select id="time" name="time" required>
                <option value="09:00-12:00">09:00-12:00</option>
                <option value="13:00-16:00">13:00-16:00</option>
                <option value="17:00-20:00">17:00-20:00</option>
            </select>
            <label for="people">預約人數：</label>
            <input type="number" id="people" name="people" min="1" max="14" required>
            <label for="space">預約空間：</label>
            <select id="space" name="space" required>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
            </select>
            <button type="submit">預約！</button>
        </form>
    </div>

    <!-- <div class="content" id="pg4">
        <h1>刪除預約！</h1>
        <form action="delete.php" method="post">
            <label for="date">預約日期：</label>
            <input type="date" id="date" name="date" required>
            <label for="time">預約時間：</label>
            <select id="time" name="time" required>
                <option value="09:00-12:00">09:00-12:00</option>
                <option value="13:00-16:00">13:00-16:00</option>
                <option value="17:00-20:00">17:00-20:00</option>
            </select>
            <label for="people">預約人數：</label>
            <input type="number" id="people" name="people" min="1" max="10" required>
            <label for="space">預約空間：</label>
            <select id="space" name="space" required>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
            </select>
            <input type="submit" value="Submit">
        </form>
    </div> -->

    <div class="content" id="pg5">
        <h1>Setting</h1>
        <!-- <p>看要改密碼還是刪除帳號還是登出都可以！</p> -->
        <form action="Update.php" method="post">
            <label for="old_psw">Old Password: </label>
            <input type="password" id="old_psw" name="old_psw" required>
            <label for="nw_password">New Password:</label>
            <input type="password" id="nw_password" name="nw_password">
            <label for="cf_password">Confirm Password:</label>
            <input type="password" id="cf_password" name="cf_password">
            <button type="submit" name="change">Change Password</button>
            <button type="submit" name="delete">Delete Account</button>
            <!-- <button id="bye">登出！</button> -->
            <a href="#" id="bye">登出！</a>
        </form>
    </div>


    <script>
        $(".menuToggle").click("on", function() {
            $(".navigation").toggleClass("open");
        });
        $(".list").click("on", function() {
            $(".list").removeClass("active");
            $(this).addClass("active");
        });


        $("#HomePage").click("on", function() {
            $("#pg1").addClass("show");
            $("#pg2").removeClass("show");
            $("#pg3").removeClass("show");
            $("#pg4").removeClass("show");
            $("#pg5").removeClass("show");
        });

        $("#GoR").click("on", function() {
            $("#pg1").removeClass("show");
            $("#pg2").removeClass("show");
            $("#pg3").addClass("show");
            $("#pg4").removeClass("show");
            $("#pg5").removeClass("show");
        });

        $("#DeleteR").click("on", function() {
            $("#pg1").removeClass("show");
            $("#pg2").removeClass("show");
            $("#pg3").removeClass("show");
            $("#pg4").addClass("show");
            $("#pg5").removeClass("show");
        });

        $("#DATA").click("on", function() {
            $("#pg1").removeClass("show");
            $("#pg2").addClass("show");
            $("#pg3").removeClass("show");
            $("#pg4").removeClass("show");
            $("#pg5").removeClass("show");
        });

        $("#Logout").click("on", function() {
            $("#pg1").removeClass("show");
            $("#pg2").removeClass("show");
            $("#pg3").removeClass("show");
            $("#pg4").removeClass("show");
            $("#pg5").addClass("show");
        });

        $("#bye").click("on", function() {
            window.location.href = "index.php";
        });
    </script>
</body>

</html>