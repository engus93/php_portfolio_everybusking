<!DOCTYPE html>
<html lang="ko">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Every Busking - Concert</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/concert_information.css" rel="stylesheet">
    <link href="../css/public.css" rel="stylesheet">

    <link href="../public/side_bar.css" rel="stylesheet">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <style>
        .menu_concert{
            color: #FBAA48 !important;
        }

    </style>

</head>

<body>

<!--header 로드-->
<div class="main_nav"></div>
<script>$(".main_nav").load("/public/main_nav.php");</script>

<!-- Page Content -->
<div class="container" style="margin-top: 30px; margin-bottom: 50px">
    <!-- Page Heading/Breadcrumbs -->
    <h1 class="my_font_main text-center" style="margin-top: 5%; margin-bottom: 5%; color: #FBAA48;">곽진언의 콘서트</h1>
    <div class='information_flex_row'>
        <img src="../img/concert/곽진언_프로필.jpg" style="height: 600px; width: auto">
        <div class='information_flex_col my_font_main'>
            <div>
                <h6 align="left" style="position: relative; right: 20%">모인 금액</h6>
                <span style="font-size: 2em">1,500,000원 / </span>
                <span>50%</span>
            </div>
            <div>
                <h6 align="left" style="position: relative; right: 20%">남은 시간</h6>
                <h3>14일</h3>
            </div>
            <div>
                <h6 align="left" style="position: relative; right: 20%">공연일자</h6>
                <h3>18년 12월 29일 7시</h3>
            </div>
            <div>
                <h6 align="left" style="position: relative; right: 20%">후원자</h6>
                <h3>90명</h3>
            </div>
            <div>
                <a href="concert_ticket.html" class="btn btn-block my_font_main" style="font-size: 2em; background-color: #FBAA48; color: white" id="support">후원하기</a>
            </div>
        </div>
    </div>

    <hr style="margin-top: 70px">

    <div>

        <!-- Projects Section -->
        <section id="projects" class="projects-section bg-light" style="padding-top: 70px; padding-bottom: 50px">
            <div class="container">

                <h1 class="text-center my_font_main color_main" style="margin-bottom: 70px">프로필</h1>

                <div class='information_flex_row' style="margin-bottom: 100px">
                    <img src="../img/concert/곽진언_프로필.jpg" style="height: 600px; width: auto">
                    <div class='information_flex_col my_font_main'>
                        <div>
                            <h6 align="left" style="position: relative; right: 20%">이름</h6>
                            <span style="font-size: 2em">곽진언</span>
                        </div>
                        <div>
                            <h6 align="left" style="position: relative; right: 20%">생년월일</h6>
                            <h3>1991년 10월 23일 (27세)</h3>
                        </div>
                        <div>
                            <h6 align="left" style="position: relative; right: 20%">장르</h6>
                            <h3>어쿠스틱 발라드</h3>
                        </div>
                        <div style="text-align: left">
                            <h6 align="left" style="position: relative; right: 20%;">인사말</h6>
                            <div style=" font-size: 10px">
                                <h3>안녕하세요.</h3>
                                <h3>같이 모여서 재미있게 놀아요.</h3>
                                <h3>공연 꼭 와주실꺼죠? 하하</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <hr style="padding-bottom: 70px">
                <h1 class="text-center my_font_main color_main" style="margin-bottom: 70px">Song List</h1>

                <div class="row" style="margin-top: 30px">

                    <?php
                    require_once "../db.php";

                    $sql = mq("select * from songlist_tb where team_name = '곽진언' order by rand() limit 4;");

                    while ($board = $sql->fetch_array()) {

                        ?>

                        <!-- 1번 -->
                        <div class="row" style="margin-top: 20px; width: 100%;">
                            <div class="col-md-7">
                                <video controls style="width: 600px; height: 350px">
                                    <source src="<?= $board['video_path'] ?>" type="video/mp4">
                                </video>
                            </div>
                            <div class="col-md-5">
                                <h3 class="my_font_start" style="font-size: 2.5em"><?=$board['title']?></h3>
                                <div class="my_font_main" style="margin-top: 30px; font-size: 20px;">
                                    <?= nl2br($board['content']); ?>
                                </div>
                            </div>
                        </div>

                        <hr style="color: black; width: 97%; margin-top: 30px">

                        <?php
                    }
                    ?>

                </div>

        </section>
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

</body>

</html>