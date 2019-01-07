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

    <title>Let's Every Busking!</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/modern-business.css" rel="stylesheet">
    <link href="../css/public.css" rel="stylesheet">

    <link href="../public/side_bar.css" rel="stylesheet">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <style>
        .list-table {
            margin-top: 40px;
        }

        .list-table thead th {
            height: 40px;
            border-top: 2px solid #FBAA48;
            border-bottom: 1px solid #CCC;
            font-weight: bold;
            font-size: 17px;
            text-align: center;
        }

        .list-table tbody td {
            text-align: center;
            padding: 10px 0;
            border-bottom: 1px solid #CCC;
            height: 20px;
            font-size: 14px
        }


    </style>

</head>

<body>

<!--footer 로드-->
<div class="main_nav"></div>
<script>$(".main_nav").load("/public/main_nav.php");</script>


<!-- Page Content -->
<div class="container my_font_main" style="position: relative; min-height: 800px">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3 my_font_index">My Page</h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="my_page_modify.php" style="color: black">내 정보 수정</a>
        </li>

        <li class="breadcrumb-item">
            <a class="color_point" href="my_page_application.php" style="color: black">신청 내역 보기</a>
        </li>

    </ol>

    <!-- Page Heading/Breadcrumbs -->
    <h4 class="my_font_main" style="margin-top: 50px;">팀노바 님의 신청 내역</h4>

    <div style="position: relative;margin-left:45px; margin-top: 50px">
        <!-- /.container -->
        <table class="list-table">

            <thead>
            <tr>
                <th width="100">번호</th>
                <th width="550">희망 날짜 / 신청 내용</th>
                <th width="120">신청 종류</th>
                <th width="150">작성일</th>
                <th width="100">여부</th>
            </tr>
            </thead>

            <tbody>

            <tr>
                <td width=100">4</td>
                <td width="550">19년 01월 05일 8시 / 공연 라이브 스트리밍 신청합니다.</a></td>
                <td width="120">스트리밍 방송</td>
                <td width="150">2019-01-02</td>
                <td width="100">대기</td>
            </tr>

            <tr>
                <td width=100">3</td>
                <td width="550">18년 12월 29일 8시 / 공연 라이브 스트리밍 신청합니다.</a></td>
                <td width="120">스트리밍 방송</td>
                <td width="150">2018-12-24</td>
                <td width="100">승인</td>
            </tr>

            <tr>
                <td width=100">2</td>
                <td width="550">18년 12월 22일 8시 / 공연 라이브 스트리밍 신청합니다.</a></td>
                <td width="120">스트리밍 방송</td>
                <td width="150">2018-12-18</td>
                <td width="100">승인</td>
            </tr>

            <tr>
                <td width=100">1</td>
                <td width="550">18년 12월 15일 8시 / 공연 라이브 스트리밍 신청합니다.</a></td>
                <td width="120">스트리밍 방송</td>
                <td width="150">2018-12-12</td>
                <td width="100">승인</td>
            </tr>
            </tbody>

        </table>

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