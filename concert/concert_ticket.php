<?php
include "../db.php";
session_start();

$bno = $_GET['idx'];

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
    <link href="../css/concert.css" rel="stylesheet">
    <link href="../css/public.css" rel="stylesheet">

    <link href="../public/side_bar.css" rel="stylesheet">
    <link href="../css/concert_information.css" rel="stylesheet">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <style>
        .menu_concert {
            color: #FBAA48 !important;
        }

    </style>

    <script>

        function payment(){

            forming = document.form;
            forming.submit();

        }

    </script>


</head>

<body onload="init();">

<!--header 로드-->
<div class="main_nav"></div>
<script>$(".main_nav").load("/public/main_nav.php");</script>

<!-- Page Content -->
<div class="container my_font_main" style="min-height: 800px; padding-bottom: 70px">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3 my_font_index" style="padding-bottom: 50px">Payment</h1>

    <section id="projects" class="projects-section bg-light"
             style="padding-top: 30px; padding-bottom: 10px; margin-bottom: 100px">
        <div class="container">

            <h3 class="mt-4 mb-3 my_font_main" style="padding-bottom: 40px; margin-left: 50px">공연 정보</h3>

            <div class='information_flex_row' style="margin-bottom: 100px">
                <img src="../img/concert/곽진언_프로필.jpg" style="height: 600px; width: auto">
                <div class='information_flex_col my_font_main'>
                    <div>
                        <h6 align="left" style="position: relative; right: 20%">공연 날짜</h6>
                        <span class="color_point" style="font-size: 2em"><?= $board['concert_date'] ?> 8시</span>
                    </div>
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

        </div>
    </section>

    <h3 class="mt-4 mb-3 my_font_main" style="padding-bottom: 40px; margin-left: 50px">상품 선택 하기</h3>
    <!-- Page Content -->

    <div class="row" id="check_group">

        <form style="width: 100%" name="form_content">

            <input type="hidden" name="check_box1" value="옵션1 : 그냥 후원하기 : 1000원">
            <input type="hidden" name="check_box2" value="옵션2 : 콘서트 티켓 : 12,000원">
            <input type="hidden" name="check_box3" value="옵션3 : 콘서트 티켓 + 굿즈 : 20,000원">

            <div class="mb-3 col-8 offset-2 center" style="min-height: 150px; border-radius: 10px; border: 1px black"
                 id="re_support_hover1">
                <input name="check_box" type="checkbox" id="test-1" aria-label="Checkbox for following text input"
                       onclick="doOpenCheck(this)">
                <label disabled type="text" for="test-1" class="form-control center"
                       aria-label="Text input with checkbox"
                       id="re_text_1"
                       style="background-color: transparent; border-color: transparent; padding-top: 50px;padding-bottom: 50px; font-size: 18px">옵션
                    1 : 그냥 후원하기 : 1000원</label>
            </div>

            <div class="mb-3 col-8 offset-2 center" style="min-height: 150px; border-radius: 10px;"
                 id="re_support_hover2">
                <input name="check_box" type="checkbox" id="test-2" aria-label="Checkbox for following text input"
                       onclick="doOpenCheck(this)">
                <label disabled type="text" for="test-2" class="form-control center"
                       aria-label="Text input with checkbox"
                       id="re_text_2"
                       style="background-color: transparent;padding-top: 50px;padding-bottom: 50px; border-color: transparent; height: 100%; font-size: 18px">옵션
                    2
                    : 콘서트 티켓 : 12,000원</label>
            </div>

            <div class="input-group mb-3 col-8 offset-2 center" style="min-height: 150px; border-radius: 10px"
                 id="re_support_hover3">
                <input name="check_box" type="checkbox" id="test-3" aria-label="Checkbox for following text input"
                       onclick="doOpenCheck(this)">
                <label disabled type="text" for="test-3" class="form-control center"
                       aria-label="Text input with checkbox"
                       id="re_text_3"
                       style="padding-top: 50px;padding-bottom: 50px;background-color: transparent; border-color: transparent; height: 100%; font-size: 18px">옵션
                    3
                    : 콘서트 티켓 + 굿즈 : 20,000원</label>
            </div>

        </form>

        <form id="form_re" class="mb-3 col-8 offset-2" name="form" method="get" action="/concert/concert_payment.php"
              style="min-height: 150px; border-radius: 10px; width: 100%; margin-top: 50px; padding-top: 25px; border: #FBAA48 1px solid; display: none">

            <h6 style="margin-bottom: 20px">결제 금액</h6>
            <div class="text-center">
                수량 : <input id="price_re" type=hidden name="sell_price" value="0">
                <input class="text-center" id="count_re" style="margin-left: 5px;" type="text" name="amount" value="1"
                       size="3" onchange="change();">
                <input style="margin-left: 5px;" class="btn" type="button" value=" + " onclick="add();">
                <input style="margin-left: 5px;" class="btn" type="button" value=" - " onclick="del();">
                <div style="display: inline; margin-left: 70px">
                    <input class="text-center" type="text" name="sum" size="11" readonly
                           style="border-color: transparent">
                    <span>원</span>
                </div>
            </div>
        </form>
    </div>

    <div class="text-center" style="margin-top: 50px">
        <button type="button" class="btn hover_class btn-lg" id="support_hover" style="border: #FBAA48 1px solid; width: 120px; margin-right: 10px" onclick="history.back()">취소하기</button>
        <button type="button" class="btn hover_class btn-lg" disabled id="support_hover2" style="border: #FBAA48 1px solid; width: 120px; margin-left: 10px" onclick="payment()">펀딩하기</button>
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
<script src="/concert/concert_ticket.js"></script>

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
    <img src="/img/up-arrow.png" style="width: 50px; height: 50px"/>
</a>
</body>

</html>