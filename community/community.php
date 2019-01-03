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

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <style>
        .menu_community{
            color: #FBAA48 !important;
        }

    </style>

</head>

<body>

<!--header 로드-->
<div class="main_nav"></div>
<script>$(".main_nav").load("/public/main_nav.php");</script>


<div class="container">

    <h1 class="mt-4 mb-3 my_font_index">Community</h1>

    <h6 class="my_font_main">※ 깨끗한 인터넷 문화를 만들어갑시다. :)</h6>

    <div class="row" style="margin-top: 50px">

        <hr>
        <section id="pinBoot" style="margin-bottom: 30px">

        <?php
        require_once "../db.php";

        $sql = mq("select * from community_tb order by idx desc limit 0,12"); // board테이블에있는 idx를 기준으로 내림차순해서 5개까지 표시

        $ss = "../img/busking_defualt.jpg";

        while ($board = $sql->fetch_array()) {

            $title = $board["title"];
            $content = $board["content"];

            //한글이랑 영어랑 용량이 다름 일단 넘김
            if (strlen($board["title"]) > 40) {
                $title = str_replace($board["title"], iconv_substr($board["title"], 0, 14, "utf-8"). "...", $board["title"]);
            }

            if (strlen($content) > 60) {
                $content = str_replace($content, iconv_substr($board["content"], 0, 30, "utf-8") . "...", $board["content"]);
            }

            echo '<article class="white-panel"><a style="text-decoration: none" href="community_read.php?idx='.$board["idx"].'"><img src="' . $board["picture"] . '"/>';
            echo '<h4 class="my_font_start">' . $title . '</h4>';
            echo '<p class=" my_font_main" style="color: black">' . $content . '</p></a>';
            echo '</article>';
        }

        ?>

        </section>
        <div style="position: relative">
            <div id="write_btn" style="position:absolute; right: 0px; bottom: 0px; width: 70px;">
                <a href="/community/community_write.php">
                    <button class="btn my_font_main" id="wright" style="background-color: #FBAA48; color: white;">글쓰기</button>
                </a>
            </div>
        </div>
    </div>

</div>

<ul class="pagination justify-content-center" style="margin-top: 20px; margin-bottom: 20px">
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
