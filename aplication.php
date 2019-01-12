<?php
require_once "db.php";

session_start();

if ($_SESSION == null) {
    echo '<script>alert("로그인 후 이용바랍니다.");history.back()</script>';
}

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Every Busking - Community</title>

    <!-- Bootstrap core CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/modern-business.css" rel="stylesheet">
    <link href="/public/side_bar.css" rel="stylesheet">
    <link href="/css/public.css" rel="stylesheet">
    <link href="/community/community.css" rel="stylesheet">
    <link href="/community/community_write.css" rel="stylesheet">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>

<!--header 로드-->
<div class="main_nav"></div>
<script>$(".main_nav").load("/public/main_nav.php");</script>

<div class="container" style="min-height: 700px; margin-bottom: 100px">

    <h1 class="mt-4 mb-3 my_font_index">Application</h1>

    <h6 class="my_font_main">※ 깨끗한 인터넷 문화를 만들어갑시다. :)</h6>

    <form action="application_write_p.php" method="post" enctype="multipart/form-data">

        <div style="margin-left: 105px">

            <select class="custom-select center" name="select_name" style="width: 900px; margin-top: 30px">
                <option selected>선택해주세요</option>
                <option value="Provide a place">Provide a place (장소 제공 신청)</option>
                <option value="Busking">Busking (공연 신청)</option>
                <option value="Streaming">Streaming (라이브 방송 신척)</option>
            </select>

        </div>

        <div id="in_content" class="center my_font_main">
            <textarea name="select_content" id="ucontent" placeholder="간단한 내용" required style="height: 300px"></textarea>
        </div>

        <div class="center my_font_main" style="margin-top: 50px">
            <button class="btn" type="submit">신청하기</button>
        </div>
    </form>

</div>

<!--footer 로드-->
<div class="main_footer"></div>
<script>$(".main_footer").load("/public/main_footer.html");</script>

<!-- Bootstrap core JavaScript -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js"></script>
<script src="../public/side_bar.js"></script>
<script src="community.js"></script>

</body>

</html>
