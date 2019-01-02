<!DOCTYPE html>
<html lang="ko">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Every Busking - Community</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/modern-business.css" rel="stylesheet">
    <link href="../side_bar.css" rel="stylesheet">
    <link href="../css/public.css" rel="stylesheet">
    <link href="community.css" rel="stylesheet">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>

<!--사이드바-->
<div id="wrapper" class="animate">
    <nav class="navbar header-top fixed-top navbar-expand-lg navbar-dark bg-dark">
        <span class="navbar-toggler-icon leftmenutrigger"></span>
        <a class="navbar-brand" href="../main.php"
           style="font-family: 'Monoton', cursive; margin-left: 10px; font-size: 20px;">Every
            Busking</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                aria-controls="navbarText"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav animate side-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../buskingteam.html" title="Dashboard"><i
                                class="fas fa-users side_bar_img"></i>Busking Team<i
                                class="fas fa-cube shortmenu animate"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../busking_zone.html" title="Cart"><i
                                class="fas fa-map-marker-alt side_bar_img"></i>Busking Zone<i
                                class="fas fa-cart-plus shortmenu animate"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../streaming.html" title="Comment"><i
                                class="fas fa-video side_bar_img"></i>Streaming<i
                                class="fas fa-comment shortmenu animate"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link color_main" href="community.php" title="Comment"><i
                                class="fas fa-star side_bar_img"></i>Community<i
                                class="fas fa-comment shortmenu animate"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../concert.html" title="Comment"><i
                                class="fas fa-compact-disc side_bar_img"></i>Concert<i
                                class="fas fa-comment shortmenu animate"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-md-auto d-md-flex">
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-user"></i> Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Sign/sign_in.html"><i class="fas fa-key"></i> Sign in</a>
                </li>
            </ul>
        </div>
    </nav>
</div>

<div class="container">
    <div class="row">
        <h2>Pinterest Responsive Grid</h2>

        <hr>


        <section id="pinBoot">

            <?php
            require_once "../db.php";

            // 쿼리 만들기
            $sql = "SELECT * FROM community_tb order by idx desc limit 0,5";

            // DB 에 쿼리 날리기
            $result = mysqli_query($conn, $sql);

            // 쿼리 결과를 PHP 에서 사용할 수 있도록 변경
            $row = mysqli_fetch_assoc($result);

            while ($board = mysqli_fetch_array($result)) {
                $title = $board["title"];

                //title이 30을 넘어서면 ...표시
                if (strlen($title) > 30) {
                    $title = str_replace($board["title"], mb_substr($board["title"], 0, 30, "utf-8") . "...", $board["title"]);
                }
            }
            ?>


            <article class="white-panel">
<!--                <img src="http://i.imgur.com/sDLIAZD.png" alt="">-->
                <h4><a href="#"><?php echo $board['title'];?></a></h4>
                <p><?php echo $board['content'];?></p>
            </article>

        </section>

    </div>

</div>

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white my_font_logo">Every Busking</p>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js"></script>
<script src="../side_bar.js"></script>
<script src="community.js"></script>

</body>

</html>
