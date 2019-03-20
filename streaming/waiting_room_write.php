<?php
require_once "../db.php";

session_start();

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
        .menu_streaming {
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

<div class="container" style="margin-bottom: 100px; min-height: 700px">

    <h1 class="mt-4 mb-3 my_font_index">Streaming</h1>

    <h6 class="my_font_main">※ 깨끗한 인터넷 문화를 만들어갑시다. :)</h6>

    <form action="/streaming/waiting_room_write_p.php" method="post" enctype="multipart/form-data">

        <div class="img_wrap center" style="width: 100%">
            <img id="img" style="height: 300px; width: 540px;" src="/img/no_image.gif"/>
        </div>

        <div id="in_title" class="center my_font_main">
            <textarea class="text-center" name="title" id="utitle" rows="1" cols="55" placeholder="방 제목" maxlength="30" required
                      style="padding-top: 10px"></textarea>
        </div>

        <div id="in_file" class="my_font_main center" style="margin-left: 0px; margin-top: 20px">
            <input type="file" id="input_img" value="1" name="c_file"/>
        </div>

        <div class="center my_font_main" style="margin-top: 50px">
            <button class="btn" type="submit">등록하기</button>
        </div>

        <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
        <input type="hidden" name="user_name" value="<?= $_SESSION['name'] ?>">
    </form>

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
