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

<body onload="init();">

<!--header 로드-->
<div class="main_nav"></div>
<script>$(".main_nav").load("/public/main_nav.php");</script>

<!-- Page Content -->
<div class="container my_font_main" style="min-height: 800px; padding-bottom: 200px">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3 my_font_index" style="padding-bottom: 50px">Payment</h1>

    <h3 class="mt-4 mb-3 my_font_main" style="padding-bottom: 40px; margin-left: 50px">상품 선택 하기</h3>
    <!-- Page Content -->

    <div class="row" id="check_group">

        <form style="width: 100%">

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

        <form id="form_re" class="text-center mb-3 col-8 offset-2" name="form" method="get"
              style="min-height: 100px; border-radius: 10px; width: 100%; margin-top: 50px; padding-top: 25px; border: #FBAA48 1px solid; display: none">
            수량 : <input id="price_re" type=hidden name="sell_price" value="0">
            <input class="text-center" id="count_re" style="margin-left: 5px;" type="text" name="amount" value="1" size="3" onchange="change();">
            <input style="margin-left: 5px;" class="btn" type="button" value=" + " onclick="add();">
            <input style="margin-left: 5px;" class="btn" type="button" value=" - " onclick="del();">
            <div style="display: inline; margin-left: 70px">
                <input class="text-center" type="text" name="sum" size="11" readonly style="border-color: transparent">
                <span>원</span>
            </div>
        </form>
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
</body>

</html>