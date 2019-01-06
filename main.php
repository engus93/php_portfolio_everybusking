<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ko">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Let's Every Busking!</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">
    <link href="css/public.css" rel="stylesheet">

    <link href="side_bar.css" rel="stylesheet">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>

<!--footer 로드-->
<div class="main_nav"></div>
<script>$(".main_nav").load("/public/main_nav.php");</script>

<!--슬라이드 사진 메인-->
<header style="margin-top: 0px">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner  my_font_index" role="listbox">
            <!-- Slide One - Set the background image for this slide in the line below -->
            <div class="carousel-item active" style="background-image: url('img/main_cover_01.jpg')">
                <div class="carousel-caption d-none d-md-block">
                    <h2>Concert</h2>
                </div>
            </div>
            <!-- Slide Two - Set the background image for this slide in the line below -->
            <div class="carousel-item" style="background-image: url('img/main_cover_02.jpg')">
                <div class="carousel-caption d-none d-md-block">
                    <h2>Music</h2>
                </div>
            </div>
            <!-- Slide Three - Set the background image for this slide in the line below -->
            <div class="carousel-item" style="background-image: url('img/main_cover_03.jpg')">
                <div class="carousel-caption d-none d-md-block">
                    <h2>Public Relations</h2>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</header>

<!-- Page Content -->
<div class="container">

    <!-- 첫 인삿말 -->
    <h1 class="text-center my_font_start" style="font-size: 5em ; text-align: center;
      margin-top: 4%; margin-bottom: 4%; color:#383A3F">
        Start! Every Busking! </h1>

    <!-- Marketing Icons Section -->
    <div class="row" style="margin-top: 7em; margin-bottom: 7em">
        <div class="col-lg-4 mb-4">
            <!-- <div class="card h-100"> -->
            <h4 class="card-header my_font_index color_main"
                style="background: transparent; text-align: center; font-size: 2em"><strong>Place</strong></h4>
            <div class="card-body text-center my_font_main">
                <p class="card-text">
                <p>당신의 장소가 너무 조용한가요?</p>
                <p>그렇다면 신청하세요!</p> 당신의 장소를 원하는 사람이 있습니다!
                </p>
            </div>
            <div class="card-footer" style="background: transparent">
                <a href="aplication.html" class="btn btn-block my_font_main color_main"
                   style="font-size: 1.2em;">신청하기</a>
            </div>
            <!-- </div> -->
        </div>
        <div class="col-lg-4 mb-4">
            <!-- <div class="card h-100"> -->
            <h4 class="card-header my_font_index color_main"
                style="background: transparent; text-align: center; font-size: 2em">
                <strong>Busking</strong></h4>
            <div class="card-body text-center my_font_main">
                <p class="card-text">
                <p>공연을 하고 싶으신가요?</p>
                <p>그렇다면 신청하세요!</p> 당신의 노래를 원하는 사람이 있습니다!
                </p>
            </div>
            <div class="card-footer" style="background: transparent">
                <a href="aplication.html" class="btn btn-block my_font_main color_main"
                   style="font-size: 1.2em;">신청하기</a>
            </div>
            <!-- </div> -->
        </div>
        <div class="col-lg-4 mb-4">
            <!-- <div class="card h-100"> -->
            <h4 class="card-header my_font_index color_main"
                style="background: transparent; text-align: center; font-size: 2em">
                <strong>Streaming</strong></h4>
            <div class="card-body text-center my_font_main">
                <p class="card-text">
                <p>소통 하고 싶으신가요?</p>
                <p>그렇다면 신청하세요!</p> 우리의 방송으로 당신을 홍보해드릴게요!
                </p>
            </div>
            <div class="card-footer" style="background: transparent">
                <a href="aplication.html" class="btn btn-block my_font_main color_main"
                   style="font-size: 1.2em;">신청하기</a>
            </div>
            <!-- </div> -->
        </div>
    </div>
    <!-- /.row -->

    <!-- Portfolio Section -->
    <h2 class="my_font_index color_main">Public Relations </h2>

    <div class="row" style="margin-top: 30px">

    <?php
    require_once "db.php";

    $sql = mq("select * from songlist_tb order by rand() limit 6;");

    //페이징 끝

    while ($board = $sql->fetch_array()) {

    ?>

        <!-- 1번 -->
        <div class="col-lg-4 col-sm-6 portfolio-item">
            <div class="card h-100">
                <video controls style="width: auto; height: 200px">
                    <source src="<?= $board['video_path'] ?>" type="video/mp4">
                </video>
                <div class="card-body">
                    <h4 class="card-title text-center my_font_start" style="font-size: 1.7em">
<!--                        <a href="buskingteam/songlist.php" class="color_point">-->
                            <?= $board['team_name'] ?> - <?= $board['title'] ?>
<!--                        </a>-->
                    </h4>
                    <h6 class="card-text my_font_main" style="margin-top: 1.5em">
                        <?= $board['content'] ?>
                    </h6>
                </div>
            </div>
        </div>

        <?php
        }
        ?>


    </div>

    <!-- /.row -->

    <!-- Features Section -->
    <div class="row" style="margin-top: 5em; margin-bottom: 5em">
        <div class="col-lg-6">
            <h2 class="my_font_index color_main">Let's Every Busking!</h2>
            <!-- <p>Every Busking</p> -->
            <ul class="my_font_main" style="margin-top: 1em">
                <p>　</p>
                <li style="margin-top: 2em">하나! 버스킹 존으로 함께 즐거운 공간을 만들어요!</li>
                <li style="margin-top: 2em">둘! 매일 8시 스트리밍 방송으로 우리 팀을 홍보해요!</li>
                <li style="margin-top: 2em">셋! 커뮤니티를 통해 버스킹 가수들과 소통해요!</li>
                <li style="margin-top: 2em">넷! 크라우드 콘서트를 통해 내가 원하는 버스킹 콘서트에 참여해요!</li>
            </ul>
        </div>
        <div class="col-lg-6">
            <video controls muted autoplay style="width: 600px; height: 300px">
                <source src="/mp4/main/소개%20영상.mp4" type="video/mp4">
            </video>
        </div>
    </div>
</div>

<!--footer 로드-->
<div class="main_footer"></div>
<script>$(".main_footer").load("/public/main_footer.html");</script>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js"></script>
<script src="side_bar.js"></script>

</body>

</html>