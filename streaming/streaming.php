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

  <title>Every Busking - Streaming</title>

  <!-- Bootstrap core CSS -->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../css/modern-business.css" rel="stylesheet">
  <link href="../css/public.css" rel="stylesheet">

  <!-- 글씨체 -->
  <link href="https://fonts.googleapis.com/css?family=Nanum+Pen+Script" rel="stylesheet">

  <link href="../public/side_bar.css" rel="stylesheet">

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <style>
    .menu_streaming{
      color: #FBAA48 !important;
    }

  </style>

</head>

<body>

<div style="min-height: 800px">

    <form method="post" action="http://192.168.253.138:3000/stream">

        <input type="hidden" name="user_id" value="<?=$_SESSION['user_id']?>">
        <input type="hidden" name="user_name" value="<?=$_SESSION['name']?>">
        <input class="btn" type="submit" value="채팅">

    </form>

    <form method="post" action="http://192.168.253.138:3000/streamer">

        <input type="hidden" name="user_id" value="<?=$_SESSION['user_id']?>">
        <input type="hidden" name="user_name" value="<?=$_SESSION['name']?>">
        <input class="btn" type="submit" value="방송하기">

    </form>

    <a href="http://192.168.253.138:3000/emitir.html"><button>방송하기</button></a>

</div>

<!--header 로드-->
<div class="main_nav"></div>
<script>$(".main_nav").load("/public/main_nav.php");</script>


<!--footer 로드-->
<div class="main_footer"></div>
<script>$(".main_footer").load("/public/main_footer.html");</script>

<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js"></script>
<script src="../public/side_bar.js"></script>

</body>

</html>