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
            <a class="color_point" href="my_page_application.php" style="color: black">신청 내역</a>
        </li>

        <li class="breadcrumb-item">
            <a href="my_page_cloud.php" style="color: black">펀딩 진행 사항</a>
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

            <?php
            require_once "../db.php";

            //        페이징
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            $sql = mq("select * from application_tb");
            $row_num = mysqli_num_rows($sql); //게시판 총 레코드 수
            $list = 10; //한 페이지에 보여줄 개수
            $block_ct = 5; //블록당 보여줄 페이지 개수

            $block_num = ceil($page / $block_ct); // 현재 페이지 블록 구하기
            $block_start = (($block_num - 1) * $block_ct) + 1; // 블록의 시작번호
            $block_end = $block_start + $block_ct - 1; //블록 마지막 번호

            $total_page = ceil($row_num / $list); // 페이징한 페이지 수 구하기
            if ($block_end > $total_page) $block_end = $total_page; //만약 블록의 마지박 번호가 페이지수보다 많다면 마지박번호는 페이지 수
            $total_block = ceil($total_page / $block_ct); //블럭 총 개수
            $start_num = ($page - 1) * $list; //시작번호 (page-1)에서 $list를 곱한다.

            $sql = mq("select * from application_tb where write_user = '".$_SESSION['user_id']."' order by idx desc limit $start_num, $list");

            //        끝

            $num = 0;

            while ($board = $sql->fetch_array()) {

                $num += 1;

                ?>

                <tr>
                    <td width=100"><?=$num?></td>
                    <td width="550"><?=$board['select_content']?> / <?=$board['select_content']?></a></td>
                    <td width="120"><?=$board['select_name']?></td>
                    <td width="150"><?=$board['date']?></td>
                    <td width="100"><?=$board['whether']?></td>
                </tr>

                <?php
            }

            ?>

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