<?php
require_once "../db.php";
session_start();

if ($_SESSION == null) {
    echo '<script>alert("로그인 후 이용바랍니다.");location.href="/Sign/sign_in.php";</script>';
}
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Let's Every Busking!</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/modern-business.css" rel="stylesheet">
    <link href="../css/public.css" rel="stylesheet">

    <link href="../public/side_bar.css" rel="stylesheet">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>

    <script>

        var pass_chaeck = true;
        var pass_re_chaeck = true;
        var phone_chaeck = true;
        var e_mail_chaeck = true;

        function cencel() {

            alert("취소 되었습니다.");

            location.href = "/my_page/my_page_modify.php";

        }

        function search_add() {
            new daum.Postcode({
                oncomplete: function (data) {
                    // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분입니다.
                    // 예제를 참고하여 다양한 활용법을 확인해 보세요.

                    document.getElementById('post').value = data.zonecode;
                    document.getElementById('addr').value = data.roadAddress;

                    window.close();

                }
            }).open();
        }

        //비밀번호 체크
        $(document).ready(function (e) {

            var user_pwd;

            // 비밀번호 조합(영문, 숫자) 및 길이 체크 정규식
            var regExpPassword = /^(?=.*[a-zA-Z])(?=.*[0-9]).{6,16}$/;

            $(".pass_check").on("keyup", function () {

                user_pwd = document.getElementById("password").value;

                if (user_pwd.length == 0) {
                    $(this).parent().parent().find("#password").css("background-color", "#FFFFFF");
                    pass_chaeck = false;
                } else if (!regExpPassword.test(user_pwd)) {
                    $(this).parent().parent().find("#password").css("background-color", "#fc3c3c");
                    pass_chaeck = false;
                } else if (regExpPassword.test(user_pwd)) {
                    $(this).parent().parent().find("#password").css("background-color", "#FFB863");
                    pass_chaeck = true;
                }

                sign_up_check();

            });

        });

        //비밀번호 확인
        $(document).ready(function (e) {

            $(".pass_re_check").on("keyup", function () {

                // 비밀번호 조합(영문, 숫자) 및 길이 체크 정규식
                var regExpPassword = /^(?=.*[a-zA-Z])(?=.*[0-9]).{6,16}$/;

                var user_pwd = document.getElementById("password").value;
                var user_pwd_re = document.getElementById("password_re").value;

                if (user_pwd_re.length == 0) {
                    $(this).parent().parent().find("#password_re").css("background-color", "#FFFFFF");
                    pass_re_chaeck = false;
                } else if (user_pwd != user_pwd_re || !regExpPassword.test(user_pwd_re)) {
                    $(this).parent().parent().find("#password_re").css("background-color", "#fc3c3c");
                    pass_re_chaeck = false;
                } else if (user_pwd == user_pwd_re && regExpPassword.test(user_pwd_re)) {
                    $(this).parent().parent().find("#password_re").css("background-color", "#FFB863");
                    pass_re_chaeck = true;
                }

                sign_up_check();

            });

        });

        //전화번호
        $(document).ready(function (e) {

            // 휴대폰번호 정규식
            var regExpMobile = /^01([016789]?)-?([0-9]{3,4})-?([0-9]{4})$/;

            $(".user_phone").on("keyup", function () {

                var user_phone = document.getElementById("phone").value;

                if (user_phone.length == 0) {
                    $(this).parent().parent().find("#phone").css("background-color", "#FFFFFF");
                    phone_chaeck = false;
                } else if (user_phone.length < 11 || !regExpMobile.test(user_phone)) {
                    $(this).parent().parent().find("#phone").css("background-color", "#fc3c3c");
                    phone_chaeck = false;
                } else if (regExpMobile.test(user_phone) && user_phone.length == 11) {
                    $(this).parent().parent().find("#phone").css("background-color", "#FFB863");
                    phone_chaeck = true;
                }

                sign_up_check();

            });

        });

        //이메일
        $(document).ready(function (e) {

            //이름 한글
            var regExp = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*\.[a-zA-Z]{3}$/i;

            $(".user_e_mail").on("keyup", function () {

                var user_mail = document.getElementById("e_mail").value;

                if (user_mail.length == 0) {
                    $(this).parent().parent().find("#e_mail").css("background-color", "#FFFFFF");
                    e_mail_chaeck = false;
                } else if (!regExp.test(user_mail)) {
                    $(this).parent().parent().find("#e_mail").css("background-color", "#fc3c3c");
                    e_mail_chaeck = false;
                } else if (regExp.test(user_mail)) {
                    $(this).parent().parent().find("#e_mail").css("background-color", "#FFB863");
                    e_mail_chaeck = true;
                }

                sign_up_check();

            });

        });

        //성별
        function sex_check() {

            var st = $(":input:radio[name=sex]:checked").val();

            if (st == "Male" || st == "Female") {
                sex_chaeck = true;
            } else {
                sex_chaeck = false;
            }

            sign_up_check();

        }

        //수정 버튼 활성화
        function sign_up_check() {
            if (pass_chaeck && pass_re_chaeck && phone_chaeck && e_mail_chaeck) {
                $("#sign_up_button").prop("disabled", false);
            } else {
                $("#sign_up_button").prop("disabled", true);
            }

        }

        $("#sign_up_button").prop("disabled", true);

    </script>

    <script>

        var sel_file;

        $(document).ready(function () {
            $("#input_img").on("change", handleImgFileSelect);
        });

        function handleImgFileSelect(e) {
            var files = e.target.files;
            var filesArr = Array.prototype.slice.call(files);

            filesArr.forEach(function (f) {
                if (!f.type.match("image.*")) {
                    alert("확장자는 이미지 확장자만 가능합니다.");
                    return;
                }

                sel_file = f;

                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#img").attr("src", e.target.result);
                }
                reader.readAsDataURL(f);
            });
        }

    </script>

    <style>

        .img_wrap {
            width: 500px;
            height: 400px;
            text-align: center;
        }

        .img_wrap img {
            width: 400px;
            height: 400px;
        }

    </style>

</head>

<body>

<!--footer 로드-->
<div class="main_nav"></div>
<script>$(".main_nav").load("/public/main_nav.php");</script>

<!-- Page Content -->
<div class="container my_font_main" style="min-height: 800px">

    <?php
    if ($_SESSION["user_id"] != "rhksflwk") {

        ?>
        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3 my_font_index">My Page</h1>

        <?php

    } else {

        ?>

        <h1 class="mt-4 mb-3 my_font_index">Manager Page</h1>

        <?php

    }
    ?>

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a class="" href="my_page_modify.php" style="color: black">내 정보 수정</a>
            <?php
            if ($_SESSION["user_id"]  != "rhksflwk"){
            ?>
        <li class="breadcrumb-item">
            <a href="my_page_application.php" style="color: black">신청 내역 보기</a>
        </li>
        <?php
        } else {
            ?>

            <li class="breadcrumb-item">
                <a href="manager_busking_team.php" style="color: #fc3c3c">Busking Team</a>
            </li>

            <li class="breadcrumb-item">
                <a href="manager_busking_zone.php" style="color: black">Busking Zone</a>
            </li>

            <li class="breadcrumb-item">
                <a href="manager_streaming.php" style="color: black">Streaming</a>
            </li>

            <li class="breadcrumb-item">
                <a href="manager_community.php" style="color: black">Community</a>
            </li>

            <li class="breadcrumb-item">
                <a href="manager_concert.php" style="color: black">Concert</a>
            </li>
            <?php
        }
        ?>
    </ol>


    </article>


</div>
<!-- /.container -->


<!--footer 로드-->
<div class="main_footer"></div>
<script>$(".main_footer").load("/public/main_footer.html");</script>

<!-- Bootstrap core JavaScript -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js"></script>
<script src="../public/side_bar.js"></script>

</body>

</html>