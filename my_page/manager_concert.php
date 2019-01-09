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
                <a href="manager_application.php" style="color: black">Application</a>
            </li>

            <li class="breadcrumb-item">
                <a href="manager_busking_team.php" style="color: black">Busking Team</a>
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
                <a href="manager_concert.php" style="color: #fc3c3c">Concert</a>
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