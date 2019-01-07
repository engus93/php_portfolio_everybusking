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

    <title>Every Busking - Busking Team</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/modern-business.css" rel="stylesheet">
    <link href="../css/public.css" rel="stylesheet">

    <link href="../side_bar.css" rel="stylesheet">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <style>
        .menu_buskingteam {
            color: #FBAA48 !important;
        }

    </style>

</head>

<body>

<!--header 로드-->
<div class="main_nav"></div>
<script>$(".main_nav").load("/public/main_nav.php");</script>

<!-- Page Content -->
<div class="container" style="margin-top: 30px">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3 my_font_index">Busking Team</h1>

    <div class="row" style="margin-top: 50px">

        <?php
        require_once "../db.php";

        //        페이징
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $sql = mq("select * from buskingteam_tb");
        $row_num = mysqli_num_rows($sql); //게시판 총 레코드 수
        $list = 4; //한 페이지에 보여줄 개수
        $block_ct = 5; //블록당 보여줄 페이지 개수

        $block_num = ceil($page / $block_ct); // 현재 페이지 블록 구하기
        $block_start = (($block_num - 1) * $block_ct) + 1; // 블록의 시작번호
        $block_end = $block_start + $block_ct - 1; //블록 마지막 번호

        $total_page = ceil($row_num / $list); // 페이징한 페이지 수 구하기
        if ($block_end > $total_page) $block_end = $total_page; //만약 블록의 마지박 번호가 페이지수보다 많다면 마지박번호는 페이지 수
        $total_block = ceil($total_page / $block_ct); //블럭 총 개수
        $start_num = ($page - 1) * $list; //시작번호 (page-1)에서 $list를 곱한다.

        $sql = mq("select * from buskingteam_tb order by idx desc limit $start_num, $list");

        //페이징 끝

        while ($board = $sql->fetch_array()) {

            $title = $board["name"];

            ?>

            <!-- 1번 -->
            <div class="col-lg-6 portfolio-item">
                <div class="card h-100">
                    <a href="songlist.php?idx=<?= $board["idx"] ?>&team_name=<?= $board["name"] ?>"><img
                                class="card-img-top" src="<?= $board["team_profile"] ?>"
                                style="background-size:100% 100%; height: 350px"></a>
                    <div class="card-body my_font_main">
                        <h4 class="card-title  text-center">
                            <a href="songlist.php?team_name=<?= $board["name"] ?>" class="my_font_start"
                               style="text-decoration: none; font-size: 35px; color: #ff6666"><?= $board["name"] ?></a>
                        </h4>
                        <?php
                        if ($_SESSION != null) {
                            if ($_SESSION['user_id'] == "rhksflwk") {
                                ?>
                                <div style="position: absolute; top: 0px; right: 0px;">
                                    <button class="btn btn-flat btn-flat-icon" type="button" data-toggle="dropdown"
                                            aria-expanded="false" style="background-color: transparent;">
                                        <em class="fa fa-plus color_point"></em>
                                    </button>
                                    <div class="dropdown-menu dropdown-scale dropdown-menu-right" role="menu"
                                         style="position: absolute; transform: translate3d(-136px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a class="dropdown-item"
                                           href="buskingteam_write.php?idx=<?= $board["idx"] ?>&page=<?= $page ?>">수정</a>
                                        <a class="dropdown-item"
                                           href="buskingteam_delete_p.php?idx=<?= $board["idx"] ?>&page=<?= $page ?>">삭제</a>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>

            <?php
        }
        ?>

    </div>

    <?php
    if ($_SESSION != null) {
        if ($_SESSION['user_id'] == "rhksflwk") {
            ?>

            <div style="margin-left: 1010px;">
                <a href="/buskingteam/buskingteam_write.php">
                    <button class="btn my_font_main" id="video_upload" style="background-color: #FBAA48; color: white;">
                        버스킹 팀 등록
                    </button>
                </a>
            </div>

            <?php
        }
    }
    ?>
    <!--페이징-->

    <div id="page_num">
        <ul class="pagination justify-content-center" style="margin-top: 20px; margin-bottom: 20px">
            <?php

            //이전
            if ($page <= 1) { //만약 page가 1보다 크거나 같다면 빈값
                echo "<li class='page-item'>
                    <a class='page-link' aria-label='Previous' onclick='start_page()'>
                        <span aria-hidden='true'>&laquo;</span>
                        <span class='sr-only'>Previous</span>                    
                    </a>
                   </li>";
            } else {
                $pre = $page - 1; //pre변수에 page-1을 해준다 만약 현재 페이지가 3인데 이전버튼을 누르면 2번페이지로 갈 수 있게 함
                echo "<li class='page-item'>
                    <a class='page-link' href='?page=$pre' aria-label='Previous' style='color: black'>
                        <span aria-hidden='true'>&laquo;</span>
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
                            <span aria-hidden='true'>&raquo;</span>
                            <span class='sr-only'>Next</span>
                        </a>
                       </li>";

                } else {

                    $next = $page + 1; //next변수에 page + 1을 해준다.
                    echo "<li class='page-item'>
                    <a class='page-link' href='?page=$next' aria-label='Next' style='color: black'>
                        <span aria-hidden='true'>&raquo;</span>
                        <span class='sr-only'>Next</span>                    
                    </a>
                   </li>";

                }
            } else {
                $next = $page + 1; //next변수에 page + 1을 해준다.
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
<script src="../side_bar.js"></script>
<script src="/public/page.js"></script>

</body>

</html>