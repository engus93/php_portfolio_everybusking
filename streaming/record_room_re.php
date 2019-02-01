<?php

session_start();

if ($_SESSION == null) {
    echo '<script>alert("로그인 후 이용바랍니다."); document.location.href="/Sign/sign_in.php"</script>';
}

?>

<!--다시보기 메뉴-->

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Every Busking - Community</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://192.168.253.138/css/modern-business.css" rel="stylesheet">
    <link href="http://192.168.253.138/public/side_bar.css" rel="stylesheet">
    <link href="http://192.168.253.138/css/public.css" rel="stylesheet">
    <link href="waiting_room.css" rel="stylesheet">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <style>
        .menu_streaming {
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

        function room_name_modify(room_name, idx, page) {

            var replay_name = prompt('영상 제목을 수정해주세요', room_name);

            if (replay_name != null) {

                document.location.href = 'record_room_re_update_p.php?idx=' + idx + '&page=' + page + '&title=' + replay_name + '';

            }

        }

    </script>

</head>

<body>

<!--header 로드-->
<div class="main_nav"></div>
<script>$(".main_nav").load("/public/main_nav.php");</script>


<div class="container" style="min-height: 800px">

    <h1 class="mt-4 mb-3 my_font_index">Streaming</h1>

    <h6 class="my_font_main">※ 깨끗한 인터넷 문화를 만들어갑시다. :)</h6>

    <div class="h-100">
        <div class="d-flex h-100 justify-content-xl-end">
            <form action="/streaming/waiting_room_result.php" method="get" name="search_go">
                <div class="searchbar">
                    <input class="search_input" type="text" id="search_check" name="search" style="font-weight: bold"
                           placeholder="스트리머">
                    <a type="submit" class="search_icon" onclick="search_search()"><i class="fas fa-search"></i></a>
                </div>
            </form>
        </div>
    </div>

    <ol class="breadcrumb my_font_main" style="background-color: transparent">

        <li class="breadcrumb-item">
            <a href="waiting_room.php" style="color: black">진행 중 방송</a>
        </li>

        <li class="breadcrumb-item">
            <a href="" style="color: #fc3c3c">녹화 영상 다시보기</a>
        </li>

    </ol>

    <div class="row" style="margin-top: 30px">

        <?php
        require_once "../db.php";

        //        페이징
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $sql = mq("select * from record_streaming_tb");
        $row_num = mysqli_num_rows($sql); //게시판 총 레코드 수
        if ($row_num == 0) {
            $row_num += 1;
        }
        $list = 4; //한 페이지에 보여줄 개수
        $block_ct = 5; //블록당 보여줄 페이지 개수

        $block_num = ceil($page / $block_ct); // 현재 페이지 블록 구하기
        $block_start = (($block_num - 1) * $block_ct) + 1; // 블록의 시작번호
        $block_end = $block_start + $block_ct - 1; //블록 마지막 번호

        $total_page = ceil($row_num / $list); // 페이징한 페이지 수 구하기
        if ($block_end > $total_page) $block_end = $total_page; //만약 블록의 마지박 번호가 페이지수보다 많다면 마지박번호는 페이지 수
        $total_block = ceil($total_page / $block_ct); //블럭 총 개수
        $start_num = ($page - 1) * $list; //시작번호 (page-1)에서 $list를 곱한다.

        //페이징 끝

        $sql_re = mq("select * from record_streaming_tb order by idx desc limit $start_num, $list");
        //        $sql = mq("select * from streaming_tb order by idx desc limit $start_num, $list");

        if ($sql_re->fetch_row() == null) {
            ?>

            <div class="row my_font_main center" style="min-height: 500px; width: 100%">
                <p class="text-center" style="width: 100%">현재 녹화 된 영상이 없습니다.</p>
            </div>

            <?php
        }

        $sql_re_re = mq("select * from record_streaming_tb order by idx desc limit $start_num, $list");
        //        $sql = mq("select * from streaming_tb order by idx desc limit $start_num, $list");

        while ($board = $sql_re_re->fetch_array()) {

            ?>

            <article class="white-panel_re col-sm-6">

                <video src="<?= $board['video_path'] ?>" controls style="width: 100%; height: 300px"></video>
                <h4 class="my_font_start text-center"
                    style="margin-top: 10px"><?= $board['title'] ?></h4>

                <p class="my_font_main"
                   style=" color: black; font-size: 12px; margin-bottom: 10px; position: absolute; display: inline">
                    스트리머 : <?= $board['streamer'] ?></p>

                <p class="my_font_main"
                   style="color: black; font-size: 12px; margin-bottom: 10px; position: absolute; right: 15px; display: inline">
                    녹화 시간 : <?= $board['date'] ?></p>
                <?php
                if ($_SESSION != null) {
                    if ($_SESSION['user_id'] == "rhksflwk" || $board['user_id'] == $_SESSION['user_id']) {
                        ?>
                        <div style="position: absolute; top: 0px; right: 0px;">
                            <button class="btn btn-flat btn-flat-icon" type="button" data-toggle="dropdown"
                                    aria-expanded="false" style="background-color: transparent;">
                                <em class="fa fa-plus color_point"></em>
                            </button>
                            <div class="dropdown-menu dropdown-scale dropdown-menu-right" role="menu"
                                 style="position: absolute; transform: translate3d(-136px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    <div class="dropdown-item" style="cursor:pointer"
                                         onclick="room_name_modify('<?= $board['title'] ?>', <?= $board['idx'] ?>, <?= $page ?>)">
                                        수정
                                    </div>
                                <a class="dropdown-item" href="record_room_re_delete_p.php?idx=">삭제</a>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </article>

            <?php
        }

        ?>

    </div>

</div>

<div id="page_num" style="padding-bottom: 10px;">
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

<div class="main_footer"></div>
<script>$(".main_footer").load("/public/main_footer.html");</script>

<!-- Bootstrap core JavaScript -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js"></script>
<script src="http://192.168.253.138/public/side_bar.js"></script>
<script src="http://192.168.253.138/community/community.js"></script>
<script src="http://192.168.253.138/public/page.js"></script>

</body>

</html>
