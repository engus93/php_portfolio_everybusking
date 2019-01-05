<?php
require_once "../db.php";

session_start();

if ($_SESSION['user_id'] != "rhksflwk") {
    echo '<script>alert("관리자만 접근이 가능합니다.");history.back()</script>';
}

if (isset($_GET['idx'])) {

    $bno = $_GET['idx'];

    // 쿼리 만들기
    $sql = "SELECT * FROM songlist_tb WHERE idx='$bno'";

    // DB 에 쿼리 날리기
    $result = mysqli_query($conn, $sql);

    // 쿼리 결과를 PHP 에서 사용할 수 있도록 변경
    $row = mysqli_fetch_assoc($result);

    if ($_SESSION['user_id'] == "rhksflwk") {

        $bno = $_GET['idx'];
        $sql = mq("select * from songlist_tb where idx='$bno';");
        $board = $sql->fetch_array();

    }else{
        echo '<script type="text/javascript">alert("관리자의 권한이 필요합니다.");
           history.back();
           </script>';
    }
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
    <link href="../css/modern-business.css" rel="stylesheet">
    <link href="../side_bar.css" rel="stylesheet">
    <link href="../css/public.css" rel="stylesheet">
    <link href="/buskingteam/songlist_write.css" rel="stylesheet">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <style>
        .menu_buskingteam{
            color: #FBAA48 !important;
        }

    </style>


</head>

<body>

<!--header 로드-->
<div class="main_nav"></div>
<script>$(".main_nav").load("/public/main_nav.php");</script>

<div class="container" style="margin-bottom: 100px">

    <h1 class="mt-4 mb-3 my_font_index">Busking Team - Song List</h1>

    <h6 class="my_font_main">※ 깨끗한 인터넷 문화를 만들어갑시다. :)</h6>

        <?php

    if (isset($board)) {
        echo '
        <form action="buskingteam_update_p.php/' . $board['idx'] . '" method="post" enctype="multipart/form-data">

            <input type="hidden" name="idx" value="' . $board['idx'] . '" />
            <input type="hidden" name="page" value="' . $_GET['page'] . '" />
            <input type="hidden" name="team_profile" value="' . $board['video_path'] . '" />

                <div id="in_title" class="center">
                        <textarea name="team_name" id="utitle" rows="1" cols="55" placeholder="곡 제목" maxlength="20" required>' . $board['title'] . '</textarea>
                </div>
                
                <div id="in_content" class="center my_font_main ">
                    <textarea name="content" id="ucontent" placeholder="곡 소개" required>' . $board['content'] . '</textarea>
                </div>

                <div id="in_file" class="my_font_main" style="margin-left: 104px; margin-top: 20px">
                    <input type="file" value="1" name="b_file" />
                </div>

                <div class="center" style="margin-top: 50px">
                    <button class="btn" type="submit">수정하기</button>
                </div>
        </form>';

    } else {
        echo '
        <form action="songlist_write_p.php" method="post" enctype="multipart/form-data">
        
            <input type="hidden" name="con_num" value="' . $_GET['idx'] . '" />
            <input type="hidden" name="team_name" value="' . $_GET['team_name'] . '" />
            
            <div id="in_title" class="center my_font_main">
                    <textarea name="title" id="utitle" rows="1" cols="55" placeholder="곡 제목" maxlength="20"required style="padding-top: 10px"></textarea>
            </div>
            
            <div id="in_content" class="center my_font_main ">
                <textarea name="content" id="ucontent" placeholder="곡 소개" required></textarea>
            </div>
            
            <div id="in_file" class="my_font_main" style="margin-left: 104px; margin-top: 20px">
                <input type="file" value="1" name="b_file" />
            </div>
            
            <div class="center my_font_main" style="margin-top: 50px">
                <button class="btn" type="submit">등록하기</button>
            </div>
        </form>
    ';
    }

    ?>

</div>

<!--footer 로드-->
<div class="main_footer"></div>
<script>$(".main_footer").load("/public/main_footer.html");</script>

<!-- Bootstrap core JavaScript -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js"></script>
<script src="../side_bar.js"></script>
<script src="community.js"></script>

</body>

</html>
