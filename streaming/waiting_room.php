<?php

session_start();

if ($_SESSION == null) {
    echo '<script>alert("로그인 후 이용바랍니다."); document.location.href="/Sign/sign_in.php"</script>';
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

        // function connection(idx) {
        //
        //     form = document.getElementById("node_js" + idx);
        //     form.submit();
        // }

        function connection(idx) {

            var zzz = $("#node_js" + idx);

            var params = zzz.serialize();
            $.ajax({
                type: 'post',
                url: 'waiting_room_join_p.php',
                data: params,
                dataType: 'html',
                async: false,
                success: function (data) {
                    var user_id = $("#user_id" + idx).val();
                    var streamer_id = $("#streamer_id" + idx).val();

                    if (data > 0 || user_id == streamer_id) {
                        var form = $("#node_js" + idx);
                        form.submit();
                    } else {
                        alert("잠시 방송 대기 중 입니다.");
                    }
                }
            });
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
            <form action="/community/community_search_result.php" method="get" name="search_go">
                <div class="searchbar">
                    <input class="search_input" type="text" id="search_check" name="search" style="font-weight: bold"
                           placeholder="제목">
                    <a type="submit" class="search_icon" onclick="search_search()"><i class="fas fa-search"></i></a>
                </div>
            </form>
        </div>
    </div>

    <div class="row" style="margin-top: 30px">

        <?php
        require_once "../db.php";

        $sql = mq("select * from streaming_tb where ing = 'true' order by idx desc");

        if ($sql->fetch_row() == null) {
            ?>

            <div class="row my_font_main center" style="min-height: 500px; width: 100%">
                <p class="text-center" style="width: 100%">현재 방송 중인 영상이 없습니다.</p>
            </div>

            <?php
        }

        $sql = mq("select * from streaming_tb where ing = 'true'  order by idx desc");

        while ($board = $sql->fetch_array()) {

            ?>

            <article class="white-panel col-sm-6" onclick="connection(<?= $board['idx'] ?>)">

                <?php
                if ($board['streamer_id'] === $_SESSION['user_id']) {
                ?>

                <form id="node_js<?= $board['idx'] ?>" name="node_js" action="http://192.168.253.138:3000/streamer"
                      method="post">

                    <?php
                    } else if ($_SESSION['user_id'] == "rhksflwk") {
                    ?>
                    <!--매니저방-->
                    <form id="node_js<?= $board['idx'] ?>" name="node_js" action="http://192.168.253.138:3000/manager"
                          method="post">

                        <?php
                        } else {
                    ?>

                    <form id="node_js<?= $board['idx'] ?>" name="node_js" action="http://192.168.253.138:3000/stream"
                          method="post">

                        <?php
                        }
                        ?>

                        <a style="text-decoration: none">
                            <img src="<?= $board['picture'] ?>" style="width: 100%; height: 300px"/>
                            <h4 class="my_font_start text-center" style="margin-top: 10px"><?= $board['streamer'] ?></h4>

                            <p class="my_font_main right"
                               style="font-size: 12px; color: black; margin-bottom: 10px; display: none">
                                시청자 : <?= $board['watch_people'] ?></p>
                            <p class="my_font_main"
                               style=" color: black; font-size: 12px; margin-bottom: 10px; position: absolute; display: inline">
                                스트리머
                                : <?= $board['streamer_id'] ?></p>
                            <p class="my_font_main"
                               style="color: black; font-size: 12px; margin-bottom: 10px; position: absolute; right: 15px; display: inline">
                                방송
                                시작
                                : <?= $board['date'] ?></p>
                        </a>

                        <input type="hidden" id="streamer_id<?= $board['idx'] ?>" value="<?= $board['streamer_id'] ?>">
                        <input type="hidden" id="user_id<?= $board['idx'] ?>" name="user_id" value="<?= $_SESSION['user_id'] ?>">
                        <input type="hidden" name="user_name" value="<?= $_SESSION['name'] ?>">
                        <input type="hidden" name="room_idx" value="<?= $board['idx'] ?>">

                    </form>

            </article>

            <?php
        }

        ?>

    </div>

</div>

<div class="col-sm-10 right" style="margin-top: 100px; margin-bottom:50px">
    <div id="write_btn">
        <a href="waiting_room_write.php">
            <button class="btn my_font_main hover_class" id="support_hover" style="width: 150px">방송하기</button>
        </a>
    </div>
</div>


<!--페이징-->

<!--<div id="page_num">-->
<!--    <ul class="pagination justify-content-center" style="margin-top: 20px; margin-bottom: 20px">-->
<!--        --><?php

//        //이전
//        if ($page <= 1) {
//            echo "<li class='page-item'>
//                    <a class='page-link' aria-label='Previous' onclick='start_page()'>
//                        <span aria-hidden='true'>&laquo;</span>
//                        <span class='sr-only'>Previous</span>
//                    </a>
//                   </li>";
//        } else if ($page - 5 <= 0) { //만약 page가 1보다 크거나 같다면 빈값
//            echo "<li class='page-item'>
//                    <a class='page-link' href='?page=1' aria-label='Previous' style='color: black'>
//                        <span aria-hidden='true'>&laquo;</span>
//                        <span class='sr-only'>Previous</span>
//                    </a>
//                   </li>";
//        } else {
//            $pre = floor(($page - 1) / $block_ct) * $block_ct; //pre변수에 page-1을 해준다 만약 현재 페이지가 3인데 이전버튼을 누르면 2번페이지로 갈 수 있게 함
//            echo "<li class='page-item'>
//                    <a class='page-link' href='?page=$pre' aria-label='Previous' style='color: black'>
//                        <span aria-hidden='true'>&laquo;</span>
//                        <span class='sr-only'>Previous</span>
//                    </a>
//                   </li>";
//        }
//
//        //이전
//        if ($page <= 1) { //만약 page가 1보다 크거나 같다면 빈값
//            echo "<li class='page-item'>
//                    <a class='page-link' aria-label='Previous' onclick='start_page()'>
//                        <span aria-hidden='true'>&lsaquo;</span>
//                        <span class='sr-only'>Previous</span>
//                    </a>
//                   </li>";
//        } else {
//            $pre = $page - 1; //pre변수에 page-1을 해준다 만약 현재 페이지가 3인데 이전버튼을 누르면 2번페이지로 갈 수 있게 함
//            echo "<li class='page-item'>
//                    <a class='page-link' href='?page=$pre' aria-label='Previous' style='color: black'>
//                        <span aria-hidden='true'>&lsaquo;</span>
//                        <span class='sr-only'>Previous</span>
//                    </a>
//                   </li>";
//        }
//
//        //숫자 표시
//        for ($i = $block_start; $i <= $block_end; $i++) {
//            //for문 반복문을 사용하여, 초기값을 블록의 시작번호를 조건으로 블록시작번호가 마지박블록보다 작거나 같을 때까지 $i를 반복시킨다
//            if ($page == $i) { //만약 page가 $i와 같다면
//                echo "<li class='page-item'><a class='page-link' href='?page=$i'
//                style='color: #FBAA48; font-weight: bold;'>$i</a></li>"; //현재 페이지에 해당하는 번호에 굵은 빨간색을 적용한다
//            } else {
//                echo "<li class='page-item'><a class='page-link' href='?page=$i' style='color: black'>$i</a></li>";
//            }
//        }
//
//        //다음
//        if ($block_num >= $total_block) { //만약 현재 블록이 블록 총개수보다 크거나 같다면 빈 값
//
//            if ($page >= $total_page) { //만약 page가 페이지수보다 크거나 같다면
//
//                echo "<li class='page-item'>
//                        <a class='page-link' aria-label='Next' onclick='last_page()'>
//                            <span aria-hidden='true'>&rsaquo;</span>
//                            <span class='sr-only'>Next</span>
//                        </a>
//                       </li>";
//
//            } else {
//
//                $next = $page + 1; //next변수에 page + 1을 해준다.
//                echo "<li class='page-item'>
//                    <a class='page-link' href='?page=$next' aria-label='Next' style='color: black'>
//                        <span aria-hidden='true'>&rsaquo;</span>
//                        <span class='sr-only'>Next</span>
//                    </a>
//                   </li>";
//
//            }
//        } else {
//            $next = $page + 1; //next변수에 page + 1을 해준다.
//            echo "<li class='page-item'>
//                    <a class='page-link' href='?page=$next' aria-label='Next' style='color: black'>
//                        <span aria-hidden='true'>&rsaquo;</span>
//                        <span class='sr-only'>Next</span>
//                    </a>
//                   </li>";
//        }
//
//        //다음 블록
//        if ($block_num >= $total_block) { //만약 현재 블록이 블록 총개수보다 크거나 같다면 빈 값
//
//            if ($page >= $total_page) { //만약 page가 페이지수보다 크거나 같다면
//
//                echo "<li class='page-item'>
//                        <a class='page-link' aria-label='Next' onclick='last_page()'>
//                            <span aria-hidden='true'>&raquo;</span>
//                            <span class='sr-only'>Next</span>
//                        </a>
//                       </li>";
//
//            } else if ($page + 5 >= $total_page) { //만약 page가 페이지수보다 크거나 같다면
//
//                echo "<li class='page-item'>
//                    <a class='page-link' href='?page=$total_page' aria-label='Next' style='color: black'>
//                            <span aria-hidden='true'>&raquo;</span>
//                            <span class='sr-only'>Next</span>
//                        </a>
//                       </li>";
//
//            } else {
//
//                $next = ceil($page / $block_ct) * $block_ct + 1; //next변수에 page + 1을 해준다.
//                echo "<li class='page-item'>
//                    <a class='page-link' href='?page=$next' aria-label='Next' style='color: black'>
//                        <span aria-hidden='true'>&raquo;</span>
//                        <span class='sr-only'>Next</span>
//                    </a>
//                   </li>";
//
//            }
//        } else {
//            $next = ceil($page / $block_ct) * $block_ct + 1; //next변수에 page + 1을 해준다.
//            echo "<li class='page-item'>
//                    <a class='page-link' href='?page=$next' aria-label='Next' style='color: black'>
//                        <span aria-hidden='true'>&raquo;</span>
//                        <span class='sr-only'>Next</span>
//                    </a>
//                   </li>";
//        }
//
//        ?>

<!--    </ul>-->
<!--</div>-->

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
