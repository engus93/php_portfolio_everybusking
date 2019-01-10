<?php
require_once "../db.php";
session_start();

if ($_SESSION == null) {
    echo '<script>alert("로그인 후 이용바랍니다.");location.href="/Sign/sign_in.php";</script>';
}
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

    <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>

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
<div class="container my_font_main" style="min-height: 800px">

    <?php
    if ($_SESSION["user_id"] != "rhksflwk") {

        ?>
        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3 my_font_index">My Page</h1>

        <?php

    } else {

        ?>

        <h1 class="mt-4 mb-3 my_font_index">Manager Page</h1>

        <?php

    }
    ?>

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a class="" href="my_page_modify.php" style="color: black">내 정보 수정</a>
        </li>
            <?php
            if ($_SESSION["user_id"] != "rhksflwk"){
            ?>
        <li class="breadcrumb-item">
            <a href="my_page_application.php" style="color: black">신청 내역 보기</a>
        </li>
        <?php
        } else {
            ?>

            <li class="breadcrumb-item">
                <a href="manager_application.php" style="color: #fc3c3c">Application</a>
            </li>

            <li class="breadcrumb-item">
                <a href="manager_busking_team.php" style="color: black">Busking Team</a>
            </li>

            <li class="breadcrumb-item">
                <a href="manager_busking_zone.php" style="color: black">Busking Zone</a>
            </li>

            <li class="breadcrumb-item">
                <a href="manager_streaming.php" style="color: black">Streaming</a>
            </li>

            <li class="breadcrumb-item">
                <a href="manager_community.php" style="color: black">Community</a>
            </li>

            <li class="breadcrumb-item">
                <a href="manager_concert.php" style="color: black">Concert</a>
            </li>

            <?php
        }
        ?>
    </ol>

    <!-- Page Heading/Breadcrumbs -->
    <h4 class="my_font_main" style="margin-top: 50px;">신청 내역</h4>

    <ol class="breadcrumb" style="background-color: transparent">

        <li class="breadcrumb-item">
            <a href="manager_application.php" style="color: black">신청 내역</a>
        </li>

        <li class="breadcrumb-item">
            <a href="manager_application_processing.php" style="color: black">처리 내역</a>
        </li>

        <li class="breadcrumb-item">
            <a href="manager_application_yet.php" style="color: #fc3c3c">미처리 내역</a>
        </li>

    </ol>

    <div style="position: relative;margin-left:45px; margin-top: 50px">
        <!-- /.container -->
        <table class="list-table">

            <thead>
            <tr>
                <th width="100">번호</th>
                <th width="450">희망 날짜 / 신청 내용</th>
                <th width="100">신청자</th>
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
            $sql = mq("select * from application_tb where whether = '대기'");
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

            //        끝
            $sql = mq("select COUNT(*) from application_tb where whether = '대기'");

            $num = mysqli_fetch_array($sql);

            $num = ($num[0] + 1) - ($page - 1) * $list;

            $sql = mq("select * from application_tb where whether = '대기' order by idx desc limit $start_num, $list");

            while ($board = $sql->fetch_array()) {

                $num = $num - 1;

                ?>

                <tr>
                    <td width=100"><?= $num ?></td>
                    <td width="450"><?= $board['select_content'] ?> / <?= $board['select_content'] ?></a></td>
                    <td width="100"><?= $board['write_user'] ?></a></td>
                    <td width="120"><?= $board['select_name'] ?></td>
                    <td width="150"><?= $board['date'] ?></td>

                    <?php
                    if ($board['whether'] == "대기") {
                        ?>

                        <td width="100">
                            <form style="display: inline" method="post" action="manager_application_p.php">
                                <input type="hidden" name="whether" value="승락">
                                <input type="hidden" name="idx" value="<?=$board['idx']?>">
                                <input type="hidden" name="page" value="<?=$page?>">
                                <button type="submit" class="btn hover_class" style="font-size: 12px; padding: 3px 7px 3px 7px">
                                    승락
                                </button>
                            </form>

                            <form style="display: inline" method="post" action="manager_application_p.php">
                                <input type="hidden" name="whether" value="거절">
                                <input type="hidden" name="idx" value="<?=$board['idx']?>">
                                <input type="hidden" name="page" value="<?=$page?>">
                                <button class="btn re_hover_class" style="font-size: 12px; padding: 3px 7px 3px 7px">
                                    거절
                                </button>
                            </form>

                        </td>

                        <?php
                    } else {
                        ?>

                        <td width="100"><?= $board['whether'] ?></td>

                        <?php
                    }
                    ?>

                </tr>

                <?php
            }

            ?>

            </tbody>

        </table>

    </div>

    <div id="page_num" style="padding-bottom: 50px;">
        <ul class="pagination justify-content-center" style="margin-top: 20px;">
            <?php

            //이전 블록
            if ($page <= 1) {
                echo "<li class='page-item'>
                    <a class='page-link' aria-label='Previous' onclick='start_page()'>
                        <span aria-hidden='true'>&laquo;</span>
                        <span class='sr-only'>Previous</span>                    
                    </a>
                   </li>";
            } else if ($page - 5 <= 0) { //만약 page가 1보다 크거나 같다면 빈값
                echo "<li class='page-item'>
                    <a class='page-link' href='?page=1' aria-label='Previous' style='color: black'>
                        <span aria-hidden='true'>&laquo;</span>
                        <span class='sr-only'>Previous</span>                    
                    </a>
                   </li>";
            } else {
                $pre = floor(($page - 1) / $block_ct) * $block_ct;
                echo "<li class='page-item'>
                    <a class='page-link' href='?page=$pre' aria-label='Previous' style='color: black'>
                        <span aria-hidden='true'>&laquo;</span>
                        <span class='sr-only'>Previous</span>                    
                    </a>
                   </li>";
            }

            //이전
            if ($page <= 1) { //만약 page가 1보다 크거나 같다면 빈값
                echo "<li class='page-item'>
                    <a class='page-link' aria-label='Previous' onclick='start_page()'>
                        <span aria-hidden='true'>&lsaquo;</span>
                        <span class='sr-only'>Previous</span>                    
                    </a>
                   </li>";
            } else {
                $pre = $page - 1; //pre변수에 page-1을 해준다 만약 현재 페이지가 3인데 이전버튼을 누르면 2번페이지로 갈 수 있게 함
                echo "<li class='page-item'>
                    <a class='page-link' href='?page=$pre' aria-label='Previous' style='color: black'>
                        <span aria-hidden='true'>&lsaquo;</span>
                        <span class='sr-only'>Previous</span>                    
                    </a>
                   </li>";
            }

            //숫자 표시
            for ($i = $block_start; $i <= $block_end; $i++) {
                //for문 반복문을 사용하여, 초기값을 블록의 시작번호를 조건으로 블록시작번호가 마지박블록보다 작거나 같을 때까지 $i를 반복시킨다
                if ($page == $i) { //만약 page가 $i와 같다면
                    echo "<li class='page-item'><a class='page-link' href='?page=$i'
                style='color: #FBAA48; font-weight: bold;'>$i</a></li>"; //현재 페이지에 해당하는 번호에 굵은 빨간색을 적용한다
                } else {
                    echo "<li class='page-item'><a class='page-link' href='?page=$i' style='color: black'>$i</a></li>";
                }
            }

            //다음
            if ($block_num >= $total_block) { //만약 현재 블록이 블록 총개수보다 크거나 같다면 빈 값

                if ($page >= $total_page) { //만약 page가 페이지수보다 크거나 같다면

                    echo "<li class='page-item'>
                        <a class='page-link' aria-label='Next' onclick='last_page()'>
                            <span aria-hidden='true'>&rsaquo;</span>
                            <span class='sr-only'>Next</span>
                        </a>
                       </li>";

                } else {

                    $next = $page + 1; //next변수에 page + 1을 해준다.
                    echo "<li class='page-item'>
                    <a class='page-link' href='?page=$next' aria-label='Next' style='color: black'>
                        <span aria-hidden='true'>&rsaquo;</span>
                        <span class='sr-only'>Next</span>                    
                    </a>
                   </li>";

                }
            } else {
                $next = $page + 1; //next변수에 page + 1을 해준다.
                echo "<li class='page-item'>
                    <a class='page-link' href='?page=$next' aria-label='Next' style='color: black'>
                        <span aria-hidden='true'>&rsaquo;</span>
                        <span class='sr-only'>Next</span>                    
                    </a>
                   </li>";
            }

            //다음 블록
            if ($block_num >= $total_block) { //만약 현재 블록이 블록 총개수보다 크거나 같다면 빈 값

                if ($page >= $total_page) { //만약 page가 페이지수보다 크거나 같다면

                    echo "<li class='page-item'>
                        <a class='page-link' aria-label='Next' onclick='last_page()'>
                            <span aria-hidden='true'>&raquo;</span>
                            <span class='sr-only'>Next</span>
                        </a>
                       </li>";

                } else if ($page + 5 >= $total_page) { //만약 page가 페이지수보다 크거나 같다면

                    echo "<li class='page-item'>
                    <a class='page-link' href='?page=$total_page' aria-label='Next' style='color: black'>
                            <span aria-hidden='true'>&raquo;</span>
                            <span class='sr-only'>Next</span>
                        </a>
                       </li>";

                } else {

                    $next = ceil($page / $block_ct) * $block_ct + 1; //next변수에 page + 1을 해준다.
                    echo "<li class='page-item'>
                    <a class='page-link' href='?page=$next' aria-label='Next' style='color: black'>
                        <span aria-hidden='true'>&raquo;</span>
                        <span class='sr-only'>Next</span>                    
                    </a>
                   </li>";

                }
            } else {
                $next = ceil($page / $block_ct) * $block_ct + 1; //next변수에 page + 1을 해준다.
                echo "<li class='page-item'>
                    <a class='page-link' href='?page=$next' aria-label='Next' style='color: black'>
                        <span aria-hidden='true'>&raquo;</span>
                        <span class='sr-only'>Next</span>                    
                    </a>
                   </li>";
            }
            ?>
        </ul>
    </div>

</div>
<!-- /.container -->


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