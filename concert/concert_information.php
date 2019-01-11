<?php

include "../db.php";
session_start();

$bno = $_GET['idx'];

$today_date = date('Y-m-d');

$sql = mq("select * from concert_tb where idx='" . $bno . "'"); /* 받아온 idx값을 선택 */
$board = $sql->fetch_array();

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
    <link href="../css/concert_information.css" rel="stylesheet">
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
<div class="container" style="margin-top: 30px; margin-bottom: 50px">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="my_font_main text-center" style="margin-top: 5%; margin-bottom: 5%; color: #FBAA48;">곽진언의 콘서트</h1>
    <div class='information_flex_row'>
        <img src="../img/concert/곽진언_프로필.jpg" style="height: 600px; width: auto">
        <div class='information_flex_col my_font_main'>
            <input type="hidden" id="date<?= $board['concert_date'] ?>" value="<?= $board['concert_date'] ?>">
            <input type="hidden" id="today_date" value="<?= $today_date ?>">
            <div>
                <h6 align="left" style="position: relative; right: 20%">모인 금액</h6>
                <span style="font-size: 2em"><?= $board['money'] ?>원 / </span>
                <span><?= floor($board['money'] / 1500000) ?>%</span>
            </div>
            <div>
                <h6 align="left" style="position: relative; right: 20%;">남은 시간</h6>
                <h3 class="color_point" id="countdown" style="min-width: 230px"></h3>
            </div>
            <div>
                <h6 align="left" style="position: relative; right: 20%">공연일자</h6>
                <h3><?= $board['concert_date'] ?> 8시</h3>
            </div>
            <div>
                <h6 align="left" style="position: relative; right: 20%">후원자</h6>
                <h3><?= $board['people'] ?>명</h3>
            </div>
            <div>
                <a href="concert_ticket.php" class="btn btn-block my_font_main"
                   style="font-size: 2em; background-color: #FBAA48; color: white" id="support">후원하기</a>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        var sdd = document.getElementById("today_date").value;
        var edd = document.getElementById("date<?=$board['concert_date']?>").value;
        var ar1 = sdd.split('-');
        var ar2 = edd.split('-');
        var da1 = new Date(ar1[0], ar1[1], ar1[2]);
        var da2 = new Date(ar2[0], ar2[1], ar2[2]);
        var dif = da2 - da1;
        var cDay = 24 * 60 * 60 * 1000;// 시 * 분 * 초 * 밀리세컨

        if (parseInt(dif / cDay) <= 0) {
            document.getElementById('day_day<?=$board['idx']?>').innerText = "종료";

        } else {
            document.getElementById('day_day<?=$board['idx']?>').innerText = parseInt(dif / cDay) + "일 전";

        }

    </script>

    <div id="countdown"></div>

    <SCRIPT language=JavaScript>

        var sss = document.getElementById("date<?=$board['concert_date']?>").value;
        var aaa = sss.split('-');

        aaa[1] = aaa[1] - 1;

        var time = new Date(aaa[0], aaa[1], aaa[2]);

        CountDownTimer(time, 'countdown'); // 2017년 1월 1일까지

        function CountDownTimer(dt, id) {

            var end = new Date(dt);

            var _second = 1000;
            var _minute = _second * 60;
            var _hour = _minute * 60;
            var _day = _hour * 24;
            var timer;

            function showRemaining() {
                var now = new Date();
                var distance = end - now;
                if (distance < 0) {

                    clearInterval(timer);
                    document.getElementById(id).innerHTML = '종료 된 펀딩';

                    return;
                }
                var days = Math.floor(distance / _day);
                var hours = Math.floor((distance % _day) / _hour);
                var minutes = Math.floor((distance % _hour) / _minute);
                var seconds = Math.floor((distance % _minute) / _second);

                document.getElementById(id).innerHTML = days + '일 ';
                document.getElementById(id).innerHTML += hours + '시 ';
                document.getElementById(id).innerHTML += minutes + '분 ';
                document.getElementById(id).innerHTML += seconds + '초';
            }

            timer = setInterval(showRemaining, 1000);
        }

    </SCRIPT>

    <hr style="margin-top: 70px">

    <div>

        <!-- Projects Section -->
        <section id="projects" class="projects-section bg-light" style="padding-top: 70px; padding-bottom: 0px">
            <div class="container">

                <h1 class="text-center my_font_main color_main" style="margin-bottom: 70px">프로필</h1>

                <div class='information_flex_row' style="margin-bottom: 100px">
                    <img src="../img/concert/곽진언_프로필.jpg" style="height: 600px; width: auto">
                    <div class='information_flex_col my_font_main'>
                        <div>
                            <h6 align="left" style="position: relative; right: 20%">이름</h6>
                            <span style="font-size: 2em"><?= $board['name'] ?></span>
                        </div>
                        <div>
                            <h6 align="left" style="position: relative; right: 20%">생년월일</h6>
                            <h3><?= $board['birth'] ?></h3>
                        </div>
                        <div>
                            <h6 align="left" style="position: relative; right: 20%">장르</h6>
                            <h3><?= $board['genre'] ?></h3>
                        </div>
                        <div style="text-align: left">
                            <h6 align="left" style="position: relative; right: 20%;">인사말</h6>
                            <div style="font-size: 25px">
                                <?= nl2br($board['profile_text']); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <hr style="padding-bottom: 70px">

                <h1 class="text-center my_font_main color_main" style="margin-bottom: 70px">Song List</h1>

                <div class="row" style="margin-top: 30px">

                    <?php
                    require_once "../db.php";

                    $check = false;

                    $team_name = $board['name'];

                    $sql = mq("select * from songlist_tb where team_name = '" . $team_name . "' order by rand() limit 4;");

                    while ($board_re = $sql->fetch_array()) {

                        $check = true;

                        $position_idx = $board_re['con_num'];

                        ?>

                        <!-- 1번 -->
                        <div class="row" style="margin-top: 20px; width: 100%;">
                            <div class="col-md-7">
                                <video controls style="width: 600px; height: 350px">
                                    <source src="<?= $board_re['video_path'] ?>" type="video/mp4">
                                </video>
                            </div>
                            <div class="col-md-5">
                                <h3 class="my_font_start" style="font-size: 2.5em"><?= $board_re['title'] ?></h3>
                                <div class="my_font_main" style="margin-top: 30px; font-size: 20px;">
                                    <?= nl2br($board_re['content']); ?>
                                </div>
                            </div>
                        </div>

                        <hr style="color: black; width: 97%; margin-top: 30px">

                        <?php
                    }

                    if ($check) {
                        ?>

                        <div class="right"
                             style="width: 100%; padding-bottom: 10px; padding-right: 10px; display: inline">
                            <a href="/buskingteam/songlist.php?idx=<?= $position_idx ?>&team_name=<?= $team_name ?>">
                                <button class="btn my_font_main hover_class" id="support_hover">
                                    더 많은 영상 보러가기
                                </button>
                            </a>
                        </div>

                        <?php
                    } else {
                        ?>

                        <div class="center my_font_main" style="min-height: 300px; width: 100%;">
                            <p>등록된 영상이 없습니다.</p>
                        </div>

                        <div class="left" style="width: 100%; padding-bottom: 10px; padding-right: 10px">
                            <a href="/buskingteam/songlist.php?idx=<?= $position_idx ?>&team_name=<?= $team_name ?>">
                                <button class="btn my_font_main hover_class" id="support_hover">
                                    더 많은 영상 보러가기
                                </button>
                            </a>
                        </div>

                        <?php
                    }

                    ?>


                </div>


        </section>

    </div>

</div>

<a href="#top">Scroll to Top</a>

<!--footer 로드-->
<div class="main_footer"></div>
<script>$(".main_footer").load("/public/main_footer.html");</script>

<!-- Bootstrap core JavaScript -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js"></script>
<script src="../public/side_bar.js"></script>

<script src="/js/jquery.scroll.pack.js"></script>
<script src="/js/jquery.easing.js"></script>
<script>
    //<![CDATA[
    $(function () {
        $("#toTop").scrollToTop({speed: 1000, ease: "easeOutBack", start: 400})
    });
    //]]>
</script>

<a id="toTop" style="margin-bottom: 10px; margin-right: 10px">
    <img src="이미지 넣으셈" style="width: 50px; height: 50px"/>
</a>

</body>

</html>