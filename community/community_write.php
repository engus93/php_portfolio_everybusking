<?php
require_once "../db.php";

session_start();

if ($_SESSION == null) {
    echo '<script>alert("로그인 후 이용바랍니다.");history.back()</script>';
} else {
}
if (isset($_GET['idx'])) {
    $bno = $_GET['idx'];
    $sql = mq("select * from community_tb where idx='$bno';");
    $board = $sql->fetch_array();
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

</head>

<body>

<!--사이드바-->
<div id="wrapper" class="animate">
    <nav class="navbar header-top fixed-top navbar-expand-lg navbar-dark bg-dark">
        <span class="navbar-toggler-icon leftmenutrigger"></span>
        <a class="navbar-brand" href="../main.php"
           style="font-family: 'Monoton', cursive; margin-left: 10px; font-size: 20px;">Every
            Busking</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                aria-controls="navbarText"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav animate side-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../buskingteam.html" title="Dashboard"><i
                                class="fas fa-users side_bar_img"></i>Busking Team<i
                                class="fas fa-cube shortmenu animate"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../busking_zone.html" title="Cart"><i
                                class="fas fa-map-marker-alt side_bar_img"></i>Busking Zone<i
                                class="fas fa-cart-plus shortmenu animate"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../streaming.html" title="Comment"><i
                                class="fas fa-video side_bar_img"></i>Streaming<i
                                class="fas fa-comment shortmenu animate"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link color_main" href="community.php" title="Comment"><i
                                class="fas fa-star side_bar_img"></i>Community<i
                                class="fas fa-comment shortmenu animate"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../concert.html" title="Comment"><i
                                class="fas fa-compact-disc side_bar_img"></i>Concert<i
                                class="fas fa-comment shortmenu animate"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-md-auto d-md-flex">
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-user"></i> Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Sign/sign_in.html"><i class="fas fa-key"></i> Sign in</a>
                </li>
            </ul>
        </div>
    </nav>
</div>

<div class="container" style="margin-bottom: 100px">

    <h1 class="mt-4 mb-3 my_font_index">Community</h1>

    <h6 class="my_font_main">※ 깨끗한 인터넷 문화를 만들어갑시다. :)</h6>

    <?php

    if (isset($board)) {
        echo '<form action="community_update_p.php/' . $board['idx'] . '" method="post">
        <input type="hidden" name="idx" value="'.$board['idx'].'" />
        <div id="in_title" class="center">
                <textarea name="title" id="utitle" rows="1" cols="55" placeholder="제목" maxlength="20"
                          required>' . $board['title'] . '</textarea>
        </div>
        <div id="in_content" class="center">
            <textarea name="content" id="ucontent" placeholder="내용" required>' . $board['content'] . '</textarea>
        </div>
        <div class="center" style="margin-top: 50px">
            <button class="btn" type="submit">글 수정</button>
        </div>
    </form>';
    } else {
        echo '<form action="community_write_p.php" method="post">
        <div id="in_title" class="center">
                <textarea name="title" id="utitle" rows="1" cols="55" placeholder="제목" maxlength="20"
                          required></textarea>
        </div>
        <div id="in_content" class="center">
            <textarea name="content" id="ucontent" placeholder="내용" required></textarea>
        </div>
        <div class="center" style="margin-top: 50px">
            <button class="btn" type="submit">글 작성</button>
        </div>
    </form>';
    }

    ?>

</div>

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white my_font_logo">Every Busking</p>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js"></script>
<script src="../side_bar.js"></script>
<script src="community.js"></script>

</body>

</html>
