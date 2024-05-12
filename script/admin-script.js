$(".menuToggle").click("on", function () {
    $(".navigation").toggleClass("open");
});
$(".list").click("on", function () {
    $(".list").removeClass("active");
    $(this).addClass("active");
});

$("#HomePage").click("on", function () {
    $("#pg1").addClass("show");
    $("#pg2").removeClass("show");
    $("#pg3").removeClass("show");
    $("#pg4").removeClass("show");
    $("#pg5").removeClass("show");
});

$("#GoR").click("on", function () {
    $("#pg1").removeClass("show");
    $("#pg2").removeClass("show");
    $("#pg3").addClass("show");
    $("#pg4").removeClass("show");
    $("#pg5").removeClass("show");
});

$("#DeleteR").click("on", function () {
    $("#pg1").removeClass("show");
    $("#pg2").removeClass("show");
    $("#pg3").removeClass("show");
    $("#pg4").addClass("show");
    $("#pg5").removeClass("show");
});

$("#DATA").click("on", function () {
    $("#pg1").removeClass("show");
    $("#pg2").addClass("show");
    $("#pg3").removeClass("show");
    $("#pg4").removeClass("show");
    $("#pg5").removeClass("show");
});

$("#Logout").click("on", function () {
    $("#pg1").removeClass("show");
    $("#pg2").removeClass("show");
    $("#pg3").removeClass("show");
    $("#pg4").removeClass("show");
    $("#pg5").addClass("show");
});

$("#bye").click("on", function () {
    window.location.href = "index.php";
});


function Search() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("reservation_data");
    filter = input.value.toUpperCase();
    table = document.querySelector("table");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

$("#modify_user_psw").click("on", function () {
    var account = $("#account_data").val();
    var password = $("#password_data").val();
    var ismodify = true;
    $.ajax({
        url: "modify.php",
        type: "POST",
        data: {
            account: account,
            password: password,
            ismodify: ismodify
        },
        success: function (data) {
            // alert(data);
            location.reload();
        }
    });
});

$("#del_user").click("on", function () {
    var account = $("#account_data").val();
    var isdel = true;
    $.ajax({
        url: "modify.php",
        type: "POST",
        data: {
            account: account,
            isdel: isdel
        },
        success: function (data) {
            // alert(data);
            location.reload();
        }
    });
});

$("#insert_user").click("on", function () {
    var account = $("#account_data").val();
    var password = $("#password_data").val();
    var isinsert = true;
    $.ajax({
        url: "modify.php",
        type: "POST",
        data: {
            account: account,
            password: password,
            isinsert: isinsert
        },
        success: function (data) {
            // alert(data);
            location.reload();
        }
    });
});

$("#modify_user_res").click("on", function () {
    var old_id = $("#_id").val();
    var date = $("#date").val();
    var time = $("#time").val();
    var people = $("#people").val();
    var space = $("#space").val();
    var res_ismodify = true;
    $.ajax({
        url: "modify.php",
        type: "POST",
        data: {
            old_id: old_id,
            date: date,
            time: time,
            people: people,
            space: space,
            res_ismodify: res_ismodify
        },
        success: function (data) {
            // alert(data);
            location.reload();
        }
    });
});
$("#del_user_res").click("on", function () {
    var old_id = $("#_id").val();
    var res_isdel = true;
    $.ajax({
        url: "modify.php",
        type: "POST",
        data: {
            old_id: old_id,
            res_isdel: res_isdel
        },
        success: function (data) {
            // alert(data);
            location.reload();
        }
    });
});

$("#insert_user_res").click("on", function () {
    var account = $("#account").val();
    var date = $("#date").val();
    var time = $("#time").val();
    var people = $("#people").val();
    var space = $("#space").val();
    var res_isinsert = true;
    $.ajax({
        url: "modify.php",
        type: "POST",
        data: {
            account: account,
            date: date,
            time: time,
            people: people,
            space: space,
            res_isinsert: res_isinsert
        },
        success: function (data) {
            // alert(data);
            location.reload();
        }
    });
});