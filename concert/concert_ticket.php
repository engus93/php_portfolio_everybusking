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
    <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>


    <style>
        .menu_concert {
            color: #FBAA48 !important;
        }

    </style>

    <script>

        function search_add() {
            new daum.Postcode({
                oncomplete: function (data) {
                    // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분입니다.
                    // 예제를 참고하여 다양한 활용법을 확인해 보세요.

                    $("#post").val(data.zonecode);
                    $("#addr").val(data.roadAddress);
                    $("#user_post").val(data.zonecode);
                    $("#user_addr").val(data.roadAddress);

                    window.close();

                }
            }).open();
        }

        function payment(name, amount, e_mail, user_name, tel) {

            var IMP = window.IMP; // 생략가능
            IMP.init('imp49634896'); // 'iamport' 대신 부여받은 "가맹점 식별코드"를 사용

            IMP.request_pay({
                pg: 'inicis', // version 1.1.0부터 지원.
                pay_method: 'card',
                merchant_uid: 'merchant_' + new Date().getTime(),
                name: '주문명 : ' + name,
                amount: amount,
                buyer_email: e_mail,
                buyer_name: user_name,
                buyer_tel: tel,
                buyer_addr: $("#post").val() + $("#addr").val(),
                buyer_postcode: $("#adress_etc").val(),
            }, function (rsp) {
                if (rsp.success) {
                    form = document.form;
                    form.submit();
                } else {
                    var msg = '결제에 실패하였습니다.';
                    alert(msg);
                }
            });

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

        <form id="form_re" class="mb-3 col-8 offset-2" name="form" method="post" action="/concert/concert_payment.php"
              style="min-height: 200px; border-radius: 10px; width: 100%; margin-top: 50px; padding-top: 25px; border: #FBAA48 1px solid; display: none">

            <input type="hidden" id="user_e_mail" value="<?= $_SESSION['e_mail'] ?>">
            <input type="hidden" id="user_name" value="<?= $_SESSION['name'] ?>">
            <input type="hidden" id="user_phone" value="<?= $_SESSION['phone'] ?>">

            <h6 style="margin-bottom: 20px">결제 금액</h6>
            <div class="text-center" style="margin-bottom: 20px">
                <h6 style="display: inline;">선택 항목 :</h6>
                <input class="text-center" name="product" id="genre_text" style="display: inline; border-color: transparent" value="">
            </div>
            <div class="text-center">
                수량 : <input id="price_re" type=hidden name="sell_price" value="0">
                <input class="text-center" id="count_re" style="margin-left: 5px;" type="text" name="amount" value="1"
                       size="3" onchange="change();">
                <input style="margin-left: 5px; border: #FBAA48 1px solid" class="btn re_hover_class"
                       id="re_support_hover" type="button" value=" - " onclick="del();">
                <input style="margin-left: 5px; border: #FBAA48 1px solid" class="btn re_hover_class"
                       id="re_support_hover" type="button" value=" + " onclick="add();">
                <div style="display: inline; margin-left: 70px">
                    <input class="text-center" type="text" name="sum" size="11" readonly
                           style="border-color: transparent" id="total_price">
                    <span>원</span>
                </div>
            </div>

            <div class="offset-3" style="margin-top: 50px; padding-bottom: 30px">
                <div style="min-height: 150px; border-radius: 10px; width: 100%; display: inline;">
                    <input name="check_box_re" type="checkbox" id="re_test-1"
                           aria-label="Checkbox for following text input"
                           onclick="doOpenCheck_re(this)">
                    <label disabled type="text" for="re_test-1" class=" "
                           aria-label="Text input with checkbox"
                           id="re_text_1"
                           style="background-color: transparent; border-color: transparent; padding: 10px; font-size: 18px ">당일 날 장소에서 받기</label>
                </div>

                <div style="min-height: 150px; border-radius: 10px; width: 100%; display: inline; margin-left: 30px"
                     id="">
                    <input name="check_box_re" type="checkbox" id="re_test-2"
                           aria-label="Checkbox for following text input"
                           onclick="doOpenCheck_re(this)">
                    <label disabled type="text" for="re_test-2" class=" "
                           aria-label="Text input with checkbox"
                           id="re_text_2"
                           style="background-color: transparent; border-color: transparent; padding: 10px; font-size: 18px">집으로 미리 받기</label>
                </div>

            </div>

            <div id="address" style="padding: 30px;  display:none;">
                <label class="" style="display: ">주소</label>

                <div>
                    <input class="form-control float-lg-none col-6" type="text" size="10" name="wPostCode" id="post"
                           placeholder="우편번호" disabled style="display: inline" value="">
                    <input class="btn hover_class" id="support_hover" type="button" onclick="search_add()"
                           value="우편번호 찾기">
                </div>

                <input class="form-control" type="text" size="30" name="wRoadAddress" id="addr" placeholder="도로명주소"
                       disabled style="margin-top: 20px" value="">
                <span id="guide" style="color:#999;font-size:10px;" style="margin-top: 20px"></span>

                <input class="form-control" type="text" name="wRestAddress" placeholder="나머지 주소" id="adress_etc"
                       style="width: 100%; margin-top: 20px" value=""/>
            </div>

            <input type="hidden" id="user_post" name="user_post" value="">
            <input type="hidden" id="user_addr" name="user_addr" value="">
            <input type="hidden" name="idx" value="<?=$bno?>">
            <input type="hidden" name="busking_team" value="<?= $board['name'] ?>">

        </form>


    </div>

    <div class="text-center" style="margin-top: 50px">
        <button type="button" class="btn hover_class btn-lg" id="support_hover"
                style="border: #FBAA48 1px solid; width: 120px; margin-right: 10px" onclick="history.back()">취소하기
        </button>
        <button type="button" class="btn hover_class btn-lg" disabled id="support_hover2"
                style="border: #FBAA48 1px solid; width: 120px; margin-left: 10px"
                onclick="payment(
                        document.getElementById('genre_text').innerText, //결제 품목
                        document.getElementById('total_price').value,//결제 금액
                        document.getElementById('user_e_mail').value, //이메일
                        document.getElementById('user_name').value, //이름
                        document.getElementById('user_phone').value //전화번호
                        )">펀딩하기
        </button>
    </div>

</div>


<!--footer 로드-->
<div class="main_footer"></div>
<script>$(".main_footer").load("/public/main_footer.html");</script>

<!-- Bootstrap core JavaScript -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.1.5.js"></script>

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