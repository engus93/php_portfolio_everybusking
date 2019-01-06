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

    <title>Modern Business - Start Bootstrap Template</title>

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
<div class="container" style="position: relative">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3 my_font_index" style="margin-top: 30px">Busking Team - Song List
        <p class="my_font_start"
           style="margin-top: 30px; margin-bottom: 30px; color: black"><?= $_GET['team_name'] ?></p>
    </h1>

    <?php
    require_once "../db.php";

    //        페이징
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $sql = mq("select * from songlist_tb");
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

    $sql = mq("select * from songlist_tb where con_num='" . $_GET['idx'] . "' order by idx desc limit $start_num, $list");

    //페이징 끝

    if($sql->fetch_row() == null) {
        ?>

        <!--여기에 넣기-->

        <!-- 1번 -->
        <div class="row center my_font_main" align="center" style="min-height: 500px">
            <p>등록된 영상이 없습니다.</p>
        </div>

        <!-- 경계선 -->
        <hr>

        <?php

    }

    $sql = mq("select * from songlist_tb where con_num='" . $_GET['idx'] . "' order by idx desc limit $start_num, $list");

    while ($board = $sql->fetch_array()) {

        ?>

        <!--            자체 플레이어-->
        <!-- 1번 -->
        <div class="row">
            <div class="col-md-7">
                <video controls style="width: 600px; height: 300px">
                    <source src="<?= $board['video_path'] ?>" type="video/mp4">
                </video>
            </div>
            <div class="col-md-5">
                <h3 class="my_font_start" style="font-size: 2.5em"><?= $board['title'] ?></h3>
                <div class="my_font_main" style="margin-top: 30px; font-size: 20px; position: relative;">
                    <p><?= $board['content'] ?></p>
                </div>
            </div>
                <button class="btn btn-flat btn-flat-icon" type="button" data-toggle="dropdown"
                        aria-expanded="false" style="background-color: transparent; position: absolute; right: 0px">
                    <em class="fa fa-plus color_point"></em>
                </button>
                <div class="dropdown-menu dropdown-scale dropdown-menu-right" role="menu"
                     style="position: absolute; transform: translate3d(-136px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                    <a class="dropdown-item" href="songlist_write.php?con_num=<?= $_GET["idx"] ?>&idx=<?=$board['idx']?>&page=<?=$page?>&team_name=<?= $_GET['team_name'] ?>">수정</a>
                    <a class="dropdown-item" href="songlist_delete_p.php?idx=<?= $_GET["idx"] ?>&con_num=<?=$board['idx']?>&page=<?=$page?>&team_name=<?= $_GET['team_name'] ?>">삭제</a>
                </div>
        </div>

        <!-- 경계선 -->
        <hr>

        <?php
    }
    ?>


    <?php
    if ($_SESSION != null) {
        if ($_SESSION['user_id'] == "rhksflwk") {
            ?>

            <div style="margin-left: 1010px;">
                <a href="/buskingteam/songlist_write.php?idx=<?= $_GET['idx'] ?>&team_name=<?= $_GET['team_name'] ?>">
                    <button class="btn my_font_main" id="video_upload" style="background-color: #FBAA48; color: white;">
                        공연 영상 등록
                    </button>
                </a>
            </div>

            <?php
        }
    }
    ?>


    <!-- Pagination -->
    <ul class="pagination justify-content-center" style="padding-top: 50px">
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        <li class="page-item">
            <a class="page-link" href="#">1</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="#">2</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="#">3</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>


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


</body>

</html>