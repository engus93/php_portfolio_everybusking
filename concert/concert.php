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
<div class="container" style="margin-top: 30px; min-height: 800px">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3 my_font_index">Cloud Concert</h1>
    <h6 class="my_font_main">※ 각 콘서트는 5사무실에서 진행됩니다.</h6>

    <div class="row my_font_main" style="margin-top: 50px; margin-bottom: 10px">
        <div class="col-lg-4 mb-4" onclick="location.href='concert_information.php'">
            <div class="card h-100 text-center">
                <img class="card-img-top concert_poster" src="../img/concert/곽진언.jpg" alt="">
                <div class="card-body">
                    <h4 class="card-title my_font_start">곽진언</h4>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="background-color: #FBAA48; width: 50%"
                             aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div style="font-size: 15px; margin-top: 20px">
                        <span style="position: absolute; left: 10%">50%</span>
                        <span>1,500,000원 달성</span>
                        <span style="position: absolute; right: 10%">7일 남음</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php
    if ($_SESSION != null) {
        if ($_SESSION['user_id'] == "rhksflwk") {
            ?>

            <div style="margin-left: 1010px; padding-bottom: 50px">
                <a href="/buskingteam/buskingteam_write.php">
                    <button class="btn my_font_main" id="video_upload" style="background-color: #FBAA48; color: white;">
                        버스킹 팀 등록
                    </button>
                </a>
            </div>

            <?php
        }
    }
    ?>

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