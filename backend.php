<?php
session_start();
require_once 'dp.php';

if ($_SESSION['is_login'] == FALSE or $_SESSION['name'] != "Admin") {
    header("Location: index.php");
}

// echo "Hi {$_SESSION['name']} Login Successful!";
?>


<!-- show the all user data and allow admin to search everyone's reservation data -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Backend</title>
    <link rel="stylesheet" href="style/SideNavigationMenu.css">
    <link rel="stylesheet" href="style/table.css">
    <link rel="stylesheet" href="style/content.css">
    <link rel="stylesheet" href="style/backend_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <!-- <h1>Backend</h1> -->
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
                    <span class="text">使用者資訊</span>
                </a>
            </li>
            <!-- <li class="list" style="--clr:#0fc70f;">
                <a href="#" id="GoR">
                    <span class="icon"><ion-icon name="chatbubble-outline"></ion-icon></span>
                    <span class="text">前往預約！</span>
                </a>
            </li>
            <li class="list" style="--clr:#2196f3;">
                <a href="#" id="DeleteR">
                    <span class="icon"><ion-icon name="camera-outline"></ion-icon></span>
                    <span class="text">修改預約！</span>
                </a>
            </li> -->
            <li class="list" style="--clr:#b145e9;">
                <a href="#" id="Logout">
                    <span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
                    <span class="text">Setting</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="content show" id="pg1">
        <h1>所有預約資訊！</h1>
        <form method="get" class="Query">
            <!-- <h3>查詢預約資訊</h3> -->
            <!-- <label for="reservation_date" id="res_date">輸入帳號：</label> -->
            <input type="text" id="reservation_data" name="reservation_date" placeholder="依照帳號來過濾..." onkeyup="Search()">
        </form>
        <!-- 幫任何人修改 / 新增 / 刪除預約資訊 -->
        <form method="post" class="reserve_update_admin" action="modify.php">
            <h3>修改 / 刪除 / 新增預約資訊</h3>
            <label for="old_id" id="acc">欲更動的ID & 帳號：</label>
            <!-- 顯示database中的所有id select-->
            <select id="_id" name="old_id">
                <?php
                $sql = "SELECT * FROM `reservation`";
                $result = mysqli_query($con, $sql);
                $rows = mysqli_num_rows($result);
                if ($rows == 0) {
                    echo "<option value=''>No data</option>";
                }
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$row['id']}'>{$row['id']}</option>";
                }
                ?>
            </select>
            <input type="text" id="account" name="account" placeholder="欲更動的帳號">
            <label for="date">預約日期：</label>
            <input type="date" id="date" name="date">
            <label for="time">預約時間：</label>
            <select id="time" name="time" required>
                <option value="09:00-12:00">09:00-12:00</option>
                <option value="13:00-16:00">13:00-16:00</option>
                <option value="17:00-20:00">17:00-20:00</option>
            </select>
            <label for="people">預約人數：</label>
            <input type="number" id="people" name="people" min="1" max="14">
            <label for="space">預約空間：</label>
            <select id="space" name="space">
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
            </select><br><br>
            <!-- <a id="modify_user_res" class="admin_update">修改！</a><br><br><br><br> -->
            <button name="res_ismodify" type="submit">修改！</button>
            <button name="res_isinsert" type="submit">新增！</button>
            <button name="res_isdel" type="submit">刪除！</button>
            <!-- <a id="insert_user_res" class="admin_update">新增！</a><br><br><br><br> -->
            <!-- <a id="del_user_res" class="admin_update">刪除！</a> -->
        </form>
        <table id="_2">
            <tr>
                <th>Account</th>
                <th>Password</th>
                <th>Date</th>
                <th>Time</th>
                <th>People</th>
                <th>Room</th>
                <th>ID</th>
            </tr>
            <?php
            $sql = "SELECT * FROM `reservation`";
            $result = mysqli_query($con, $sql);
            $rows = mysqli_num_rows($result);
            if ($rows == 0) {
                echo "<tr><td colspan='7'>No data</td></tr>";
            }
            while ($row = mysqli_fetch_assoc($result)) {
                $sql2 = "SELECT * FROM `Data` WHERE `account` = '{$row['account']}'";
                $password = mysqli_fetch_assoc(mysqli_query($con, $sql2))['password'];
                echo "<tr>";
                echo "<td>{$row['account']}</td>";
                echo "<td>{$password}</td>";
                echo "<td>{$row['date']}</td>";
                echo "<td>{$row['time']}</td>";
                echo "<td>{$row['people']}</td>";
                echo "<td>{$row['room']}</td>";
                echo "<td>{$row['id']}</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>

    <div class="content" id="pg2">
        <h1>使用者資訊！</h1>
        <form method="post" class="Modify Query" action="modify.php">
            <h3>修改 / 刪除 / 新增使用者</h3>
            <label for="account" id="acc_data">欲修改 / 新增 / 刪除的帳號：</label>
            <input type="text" id="account_data" name="account">
            <label for="password" id="psw_data">欲修改 / 新增的密碼：</label>
            <input type="text" id="password_data" name="password">
            <button name="ismodify" type="submit">修改！</button>
            <button name="isinsert" type="submit">新增！</button>
            <button name="isdel" type="submit">刪除！</button>
        </form>
        <table>
            <tr>
                <th>Account</th>
                <th>Password</th>
            </tr>
            <?php
            $sql = "SELECT * FROM `Data`";
            $result = mysqli_query($con, $sql);
            $rows = mysqli_num_rows($result);
            if ($rows == 0) {
                echo "<tr><td colspan='2'>No data</td></tr>";
            }
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['account'] == "user") {
                    continue;
                }
                echo "<tr>";
                echo "<td>{$row['account']}</td>";
                echo "<td>{$row['password']}</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>

    <div class="content" id="pg5">
        <!-- <p>看要改密碼還是刪除帳號還是登出都可以！</p> -->
        <form action="admin_update.php" method="post" id="del_form">
            <h3>更改密碼 / 登出</h3>
            <label for="old_psw">Old Password: * </label>
            <input type="password" id="old_psw" name="old_psw" required>
            <label for="nw_password">New Password:</label>
            <input type="password" id="nw_password" name="nw_password">
            <label for="cf_password">Confirm Password:</label>
            <input type="password" id="cf_password" name="cf_password">
            <button type="submit" name="change">Change Password</button>
            <!-- <button id="bye">登出！</button> -->
            <a href="#" id="bye">登出！</a>
        </form>
    </div>
    <script src="script/admin-script.js"></script>

    <!-- <script>

    </script> -->
</body>

</html>