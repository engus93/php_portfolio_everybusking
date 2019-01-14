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
    <link href="../public/side_bar.css" rel="stylesheet">


    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <style>
        .menu_buskingteam {
            color: #FBAA48 !important;
        }

    </style>

    <script>

        function search_search() {

            var word = document.getElementById("search_check").value;

            if (word.length != 0) {

                form = document.search_go;
                form.submit();

            } else {
                alert("검색어를 입력해주세요.")
            }

        }

    </script>

</head>

<body>

<!--header 로드-->
<div class="main_nav"></div>
<script>$(".main_nav").load("/public/main_nav.php");</script>

<!-- Page Content -->
<div class="container" style="min-height: 800px; position: relative">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3 my_font_index" style="margin-top: 30px">Busking Team - Song List
        <p class="my_font_start"
           style="margin-top: 30px; margin-bottom: 30px; color: black"></p>
    </h1>

    <div class="h-100" style="margin-bottom: 50px">
        <div class="d-flex h-100 justify-content-xl-end">
            <form action="/buskingteam/songlist_search_result.php" method="get" name="search_go">
                <input type="hidden" name="idx" value="<?= $_GET['idx'] ?>">
                <input type="hidden" name="team_name" value="<?= $_GET['team_name'] ?>">
                <div class="searchbar">
                    <input class="search_input" type="text" id="search_check" name="search" style="font-weight: bold"
                           placeholder="Song Name">
                    <a type="submit" class="search_icon" onclick="search_search()"><i class="fas fa-search"></i></a>
                </div>
            </form>
        </div>
    </div>

    <?php
    require_once "../db.php";

    //        페이징
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $sql = mq("select * from songlist_tb where title like '%" . $_GET["search"] . "%'");
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

    $sql = mq("select * from songlist_tb where title like '%" . $_GET["search"] . "%' order by idx desc");

    //페이징 끝

    if ($sql->fetch_row() == null) {
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

    $sql = mq("select * from songlist_tb where title like '%" . $_GET["search"] . "%' order by idx desc limit $start_num, $list");

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
                    <p><?= nl2br($board['content']); ?></p>
                </div>
            </div>
            <?php
            if ($_SESSION != null) {
                if ($_SESSION['user_id'] == "rhksflwk") {
                    ?>
                    <button class="btn btn-flat btn-flat-icon" type="button" data-toggle="dropdown"
                            aria-expanded="false" style="background-color: transparent; position: absolute; right: 0px">
                        <em class="fa fa-plus color_point"></em>
                    </button>
                    <div class="dropdown-menu dropdown-scale dropdown-menu-right" role="menu"
                         style="position: absolute; transform: translate3d(-136px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item"
                           href="songlist_write.php?con_num=<?= $_GET["idx"] ?>&idx=<?= $board['idx'] ?>&page=<?= $page ?>&team_name=<?= $_GET['team_name'] ?>">수정</a>
                        <a class="dropdown-item"
                           href="songlist_delete_p.php?idx=<?= $_GET["idx"] ?>&con_num=<?= $board['idx'] ?>&page=<?= $page ?>&team_name=<?= $_GET['team_name'] ?>">삭제</a>
                    </div>
                    <?php
                }
            }
            ?>
        </div>

        <!-- 경계선 -->
        <hr>

        <?php
    }

    ?>

</div>

<div class="col-8 offset-2">
    <?php
    if ($_SESSION != null) {
    if ($_SESSION['user_id'] == "rhksflwk") {
    ?>

    <a href="/buskingteam/buskingteam.php" style="float: left">
        <button class="btn my_font_main" id="video_upload" style="background-color: #FBAA48; color: white;">
            다른 버스킹 팀 보러가기
        </button>
    </a>

    <div class="right"
    ">
    <a href="/buskingteam/songlist_write.php?idx=<?= $_GET['idx'] ?>&team_name=<?= $_GET['team_name'] ?>">
        <button class="btn my_font_main" id="video_upload" style="background-color: #FBAA48; color: white;">
            공연 영상 등록
        </button>
    </a>
</div>

<?php
}
} else {
    ?>

    <a href="/buskingteam/buskingteam.php">
        <button class="btn my_font_main" id="video_upload" style="background-color: #FBAA48; color: white;">
            다른 버스킹 팀 보러가기
        </button>
    </a>

    <?php
}
?>

</div>

<?php
if ($block_end == 0) {
    $block_end = 1;
} ?>

<div id="page_num">
    <ul class="pagination justify-content-center" style="margin-top: 20px; margin-bottom: 20px">
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
                    <a class='page-link' href='?page=1&idx=" . $_GET["idx"] . "&team_name=" . $_GET["team_name"] . "' aria-label='Previous' style='color: black'>
                        <span aria-hidden='true'>&laquo;</span>
                        <span class='sr-only'>Previous</span>                    
                    </a>
                   </li>";
        } else {
            $pre = floor(($page - 1) / $block_ct) * $block_ct;
            echo "<li class='page-item'>
                    <a class='page-link' href='?page=" . $pre . "&idx=" . $_GET["idx"] . "&team_name=" . $_GET["team_name"] . "' aria-label='Previous' style='color: black'>
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
            echo '<li class="page-item">
                    <a class="page-link" href="?page=' . $pre . '&idx=' . $_GET['idx'] . '&team_name=' . $_GET['team_name'] . '" aria-label="Previous" style="color: black">
                        <span aria-hidden="true">&lsaquo;</span>
                        <span class="sr-only">Previous</span>                    
                    </a>
                   </li>';
        }

        //숫자 표시
        for ($i = $block_start; $i <= $block_end; $i++) {
            //for문 반복문을 사용하여, 초기값을 블록의 시작번호를 조건으로 블록시작번호가 마지박블록보다 작거나 같을 때까지 $i를 반복시킨다
            if ($page == $i) { //만약 page가 $i와 같다면
                echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '&idx=' . $_GET['idx'] . '&team_name=' . $_GET['team_name'] . '"
                style="color: #FBAA48; font-weight: bold;">' . $i . '</a></li>'; //현재 페이지에 해당하는 번호에 굵은 빨간색을 적용한다
            } else {
                echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '&idx=' . $_GET['idx'] . '&team_name=' . $_GET['team_name'] . '"style="color: black">' . $i . '</a></li>';
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
                echo '<li class="page-item">
                    <a class="page-link" href="?page=' . $next . '&idx=' . $_GET['idx'] . '&team_name=' . $_GET['team_name'] . '" aria-label="Next" style="color: black">';
                echo "
                        <span aria-hidden='true'>&rsaquo;</span>
                        <span class='sr-only'>Next</span>                    
                    </a>
                   </li>";

            }
        } else {
            $next = $page + 1; //next변수에 page + 1을 해준다.
            echo '<li class="page-item">
                    <a class="page-link" href="?page=' . $next . '&idx=' . $_GET['idx'] . '&team_name=' . $_GET['team_name'] . '" aria-label="Next" style="color: black">';
            echo "
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
                    <a class='page-link' href='?page=" . $total_page . "&idx=" . $_GET["idx"] . "&team_name=" . $_GET["team_name"] . "' aria-label='Next' style='color: black'>
                            <span aria-hidden='true'>&raquo;</span>
                            <span class='sr-only'>Next</span>
                        </a>
                       </li>";

            } else {

                $next = ceil($page / $block_ct) * $block_ct + 1; //next변수에 page + 1을 해준다.
                echo "<li class='page-item'>
                    <a class='page-link' href='?page=" . $next . "&idx=" . $_GET["idx"] . "&team_name=" . $_GET["team_name"] . "' aria-label='Next' style='color: black'>
                        <span aria-hidden='true'>&raquo;</span>
                        <span class='sr-only'>Next</span>                    
                    </a>
                   </li>";

            }
        } else {
            $next = ceil($page / $block_ct) * $block_ct + 1; //next변수에 page + 1을 해준다.
            echo "<li class='page-item'>
                    <a class='page-link' href='?page=" . $next . "&idx=" . $_GET['idx'] . "&team_name=" . $_GET['team_name'] . "' aria-label='Next' style='color: black'>
                        <span aria-hidden='true'>&raquo;</span>
                        <span class='sr-only'>Next</span>                    
                    </a>
                   </li>";
        }
        ?>
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
<script src="../public/side_bar.js"></script>
<script src="/public/page.js"></script>

</body>

</html>