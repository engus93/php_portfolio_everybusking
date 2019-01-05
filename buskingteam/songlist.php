<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Modern Business - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/modern-business.css" rel="stylesheet">
    <link href="../css/public.css" rel="stylesheet">
    <link href="../side_bar.css" rel="stylesheet">


    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <style>
        .menu_buskingteam {
            color: #FBAA48 !important;
        }

    </style>

</head>

<body>

<!--header 로드-->
<div class="main_nav"></div>
<script>$(".main_nav").load("/public/main_nav.php");</script>

<!-- Page Content -->
<div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3 my_font_index" style="margin-top: 30px">Busking Team - Song List
        <p class="my_font_start"
           style="margin-top: 30px; margin-bottom: 30px; color: black"><?= $_GET['team_name'] ?></p>
    </h1>

    <!--여기에 넣기-->

    <!-- 1번 -->
    <div class="row center my_font_main" align="center" style="min-height: 500px">
        <p>등록된 영상이 없습니다.</p>
    </div>

    <!-- 경계선 -->
    <hr>

    <!--            자체 플레이어-->
    <!-- 1번 -->
    <div class="row">
        <div class="col-md-7">
            <video controls>
                <source src="/mp4/video/main_loding.mp4" type="video/mp4">
            </video>
        </div>
        <div class="col-md-5">
            <h3 class="my_font_start" style="font-size: 2.5em">제목</h3>
            <div class="my_font_main" style="margin-top: 30px; font-size: 20px; position: relative;">
                <p>내용</p>
            </div>
        </div>
    </div>

    <!-- 경계선 -->
    <hr>


    <?php
    if ($_SESSION != null) {
        if ($_SESSION['user_id'] == "rhksflwk") {
            ?>

            <div style="margin-left: 1010px;">
                <a href="/buskingteam/songlist_write.php">
                    <button class="btn my_font_main" id="video_upload" style="background-color: #FBAA48; color: white;">
                        공연 영상 등록
                    </button>
                </a>
            </div>

            <?php
        }
    }
    ?>


    <!-- Pagination -->
    <ul class="pagination justify-content-center" style="padding-top: 50px">
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        <li class="page-item">
            <a class="page-link" href="#">1</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="#">2</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="#">3</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>


</div>


<!-- /.container -->

<!--footer 로드-->
<div class="main_footer"></div>
<script>$(".main_footer").load("/public/main_footer.html");</script>

<!-- Bootstrap core JavaScript -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js"></script>
<script src="../side_bar.js"></script>


</body>

</html>
