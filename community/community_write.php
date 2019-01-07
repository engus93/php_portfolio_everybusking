<?php
require_once "../db.php";

session_start();

if ($_SESSION == null) {
    echo '<script>alert("로그인 후 이용바랍니다.");history.back()</script>';
}

if (isset($_GET['idx'])) {

    $bno = $_GET['idx'];

    // 쿼리 만들기
    $sql = "SELECT * FROM community_tb WHERE idx='$bno'";

    // DB 에 쿼리 날리기
    $result = mysqli_query($conn, $sql);

    // 쿼리 결과를 PHP 에서 사용할 수 있도록 변경
    $row = mysqli_fetch_assoc($result);

    if ($row['pw'] == $_SESSION['user_id'] || $_SESSION['user_id'] == "rhksflwk") {

        $bno = $_GET['idx'];
        $sql = mq("select * from community_tb where idx='$bno';");
        $board = $sql->fetch_array();

    }else{
        echo '<script type="text/javascript">alert("자신의 게시물만 수정이 가능합니다.");
           location.href = "/community/community_read.php?idx=' . $bno . '";
           </script>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

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
    <link href="community.css" rel="stylesheet">
    <link href="community_write.css" rel="stylesheet">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <style>
        .menu_community{
            color: #FBAA48 !important;
        }

        .img_wrap {
            width: 500px;
            height: 400px;
            margin-top: 50px;
            margin-left: 305px;
        }
        .img_wrap img {
            width: auto;
            height: 100%;
        }

    </style>

    <script>

        var sel_file;

        $(document).ready(function() {
            $("#input_img").on("change", handleImgFileSelect);
        });

        function handleImgFileSelect(e) {
            var files = e.target.files;
            var filesArr = Array.prototype.slice.call(files);

            filesArr.forEach(function(f) {
                if(!f.type.match("image.*")) {
                    alert("확장자는 이미지 확장자만 가능합니다.");
                    return;
                }

                sel_file = f;

                var reader = new FileReader();
                reader.onload = function(e) {
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

    <h1 class="mt-4 mb-3 my_font_index">Community</h1>

    <h6 class="my_font_main">※ 깨끗한 인터넷 문화를 만들어갑시다. :)</h6>

        <?php

    if (isset($board)) {
        ?>
        <form action="community_update_p.php/<?=$board['idx']?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="idx" value="<?=$board["idx"]?>" />
        <input type="hidden" name="picture" value="<?=$board["picture"]?>">
        
        <div class="img_wrap center">
            <img id="img" src="<?=$board['picture']?>"/>
        </div>
        
        <div id="in_title" class="center">
                <textarea name="title" id="utitle" rows="1" cols="55" placeholder="제목" maxlength="20" required><?=$board['title']?></textarea>
        </div>
        <div id="in_content" class="center">
            <textarea name="content" id="ucontent" placeholder="내용" required><?=$board['content']?></textarea>
        </div>
        
        <div id="in_file" class="my_font_main" style="margin-left: 104px; margin-top: 20px">
            <input type="file" id="input_img" value="1" name="b_file" />
        </div>
        
        <div class="center" style="margin-top: 50px">
            <button class="btn" type="submit">글 수정</button>
        </div>
    </form>
    <?php
    } else {
        echo '<form action="community_write_p.php" method="post" enctype="multipart/form-data">

        <div class="img_wrap center">
            <img id="img" src="/img/no_image.gif"/>
        </div>

        <div id="in_title" class="center my_font_main">
                <textarea name="title" id="utitle" rows="1" cols="55" placeholder="제목" maxlength="20"required style="padding-top: 10px"></textarea>
        </div>
        
        <div id="in_content" class="center my_font_main ">
            <textarea name="content" id="ucontent" placeholder="내용" required></textarea>
        </div>
        
        <div id="in_file" class="my_font_main" style="margin-left: 104px; margin-top: 20px">
            <input type="file" id="input_img" value="1" name="b_file" />
        </div>
        
        <div class="center my_font_main" style="margin-top: 50px">
            <button class="btn" type="submit">글 작성</button>
        </div>
    </form>';
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
