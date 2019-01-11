<?php
include "../db.php";
session_start();

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Every Busking - Concert</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/concert.css" rel="stylesheet">
    <link href="../css/public.css" rel="stylesheet">

    <link href="../public/side_bar.css" rel="stylesheet">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <style>
        .menu_concert {
            color: #FBAA48 !important;
        }

    </style>

</head>

<body>

<!--header 로드-->
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
        </li>
        <?php
        if ($_SESSION["user_id"] != "rhksflwk") {
            ?>
            <li class="breadcrumb-item">
                <a href="my_page_application.php" style="color: black">신청 내역 보기</a>
            </li>
            <?php
        } else {
            ?>

            <li class="breadcrumb-item">
                <a href="manager_application.php" style="color: #fc3c3c">Application</a>
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
                <a href="manager_concert.php" style="color: black">Concert</a>
            </li>

            <?php
        }
        ?>
    </ol>

    <!-- Page Heading/Breadcrumbs -->
    <h4 class="my_font_main" style="margin-top: 50px;">신청 내역</h4>

    <ol class="breadcrumb" style="background-color: transparent">

        <li class="breadcrumb-item">
            <a href="manager_application.php" style="color: #fc3c3c">신청 내역</a>
        </li>

        <li class="breadcrumb-item">
            <a href="manager_application_processing.php" style="color: black">처리 내역</a>
        </li>

        <li class="breadcrumb-item">
            <a href="manager_application_yet.php" style="color: black">미처리 내역</a>
        </li>

    </ol>

</div>

</div>

<!-- Page Content -->
<div class="container" style="margin-top: 30px; min-height: 800px">

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <input type="checkbox" aria-label="Checkbox for following text input">
            </div>
        </div>
        <input disabled type="text" class="form-control" aria-label="Text input with checkbox" value="선택해라">
    </div>

</div>

<!--footer 로드-->
<div class="main_footer"></div>
<script>$(".main_footer").load("/public/main_footer.html");</script>

<!-- Bootstrap core JavaScript -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js"></script>
<script src="../public/side_bar.js"></script>
<script src="/public/page.js"></script>

</body>

</html>