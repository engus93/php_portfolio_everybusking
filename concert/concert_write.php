<?php
require_once "../db.php";

session_start();

if ($_SESSION['user_id'] != "rhksflwk") {
    echo '<script>alert("관리자만 접근이 가능합니다.");history.back()</script>';
}

if (isset($_GET['idx'])) {

    $bno = $_GET['idx'];

    // 쿼리 만들기
    $sql = "SELECT * FROM buskingteam_tb WHERE idx='$bno'";

    // DB 에 쿼리 날리기
    $result = mysqli_query($conn, $sql);

    // 쿼리 결과를 PHP 에서 사용할 수 있도록 변경
    $row = mysqli_fetch_assoc($result);

    if ($_SESSION['user_id'] == "rhksflwk") {

        $bno = $_GET['idx'];
        $sql = mq("select * from buskingteam_tb where idx='$bno';");
        $board = $sql->fetch_array();

    } else {
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
    <link href="../public/side_bar.css" rel="stylesheet">
    <link href="../css/public.css" rel="stylesheet">
    <link href="/buskingteam/songlist_write.css" rel="stylesheet">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <style>
        .menu_buskingteam {
            color: #FBAA48 !important;
        }

        .img_wrap {
            width: 300px;
            margin-top: 50px;
        }

        .img_wrap img {
            width: 540px;
            height: 350px;
        }

    </style>

    <script>

        var sel_file;

        $(document).ready(function () {
            $("#input_img").on("change", handleImgFileSelect);
        });

        function handleImgFileSelect(e) {
            var files = e.target.files;
            var filesArr = Array.prototype.slice.call(files);

            filesArr.forEach(function (f) {
                if (!f.type.match("image.*")) {
                    alert("확장자는 이미지 확장자만 가능합니다.");
                    return;
                }

                sel_file = f;

                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#img").attr("src", e.target.result);
                }
                reader.readAsDataURL(f);
            });
        }


    </script>

</head>

<body>

<!--header 로드-->
<div class="main_nav"></div>
<script>$(".main_nav").load("/public/main_nav.php");</script>

<div class="container" style="margin-bottom: 100px">

    <h1 class="mt-4 mb-3 my_font_index">Cloud Concert</h1>

    <h6 class="my_font_main">※ 깨끗한 인터넷 문화를 만들어갑시다. :)</h6>

    <?php

    if (isset($board)) {
        ?>
        <form action="buskingteam_update_p.php/<?= $board['idx'] ?>" method="post" enctype="multipart/form-data">

            <input type="hidden" name="idx" value="<?= $board['idx'] ?>"/>
            <?php
            if (!empty($_GET['page'])) {
                ?>
                <input type="hidden" name="page" value="<?= $_GET['page'] ?>"/>
                <?php
            } else {
                ?>

                <input type="hidden" name="manager_page" value="<?= $_GET['manager_page'] ?>"/>

                <?php
            }
            ?>
            <input type="hidden" name="team_profile" value="<?= $board['team_profile'] ?>"/>

            <div class="img_wrap" style="margin-left: 285px; height: 450px; width: auto;">
                <img id="img" src="<?= $board['team_profile'] ?>"/>
            </div>

            <div id="in_title" class="center">
                <textarea name="team_name" id="utitle" rows="1" cols="55" placeholder="가수 이름" maxlength="20"
                          required><?= $board['name'] ?></textarea>
            </div>

            <div id="in_file" class="my_font_main" style="margin-left: 104px; margin-top: 20px">
                <input type="file" id="input_img" value="1" name="b_file"/>
            </div>

            <div class="center" style="margin-top: 50px">
                <button class="btn" type="submit">수정하기</button>
            </div>
        </form>

        <?php
    } else {
        echo '
        <form action="/concert/concert_write_p.php" method="post" enctype="multipart/form-data">
        
            <div class="img_wrap" style="margin-left: 380px;">
                <img id="img" style="height: 450px; width: 350px;" src="/img/no_image.gif"/>
            </div>
        
            <div id="in_title" class="my_font_main" style="width: 600px; margin-left: 255px">
                <input class="form-control" name="team_name" rows="1" cols="55" placeholder="가수 이름" maxlength="20"required>
            </div>
            
            <div class="my_font_main" style="width: 600px; margin-left: 100px; margin-top: 20px; margin-left: 255px">
                <input class="form-control" type="date" name="date" id="datepicker1" placeholder="공연 날짜">
            </div>
            
            <div id="in_file" class="my_font_main" style="margin-left: 255px; margin-top: 20px">
                <input type="file" id="input_img" value="1" name="b_file" />
            </div>
            
            <div class="center my_font_main" style="margin-top: 50px">
                <button class="btn hover_class" id="support_hover" type="submit">콘서트 등록하기</button>
            </div>
        </form>
    ';
        ?>

        <?php

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
<script src="../public/side_bar.js"></script>
<script src="community.js"></script>

</body>

</html>
