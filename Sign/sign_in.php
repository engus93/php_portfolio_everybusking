<?php

session_start();

if (isset($_COOKIE[session_name()])) {

    setcookie(session_name(), '', time() - 42000, '/');

}

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Every Busking - Sign In</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/modern-business.css" rel="stylesheet">

    <!--Bootsrap 4 CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
          crossorigin="anonymous">

    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
          crossorigin="anonymous">

    <!--Custom styles-->
    <link rel="stylesheet" type="text/css" href="../css/sign.css">
    <link href="../css/public.css" rel="stylesheet">

    <link href="../public/side_bar.css" rel="stylesheet">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script>

        function login() {

            var id = document.getElementById("login_id").value;
            var password = document.getElementById("login_password").value;

            if (id.length == 0) {
                alert("아이디를 입력하세요");
                return false;

            } else if (password.length == 0) {

                alert("비밀번호를 입력하세요");
                return false;

            } else {
                document.login_form.submit();
                return true;

            }

        }

    </script>

    <style>
        .main_nav_sign {
            color: #FBAA48 !important;
        }

    </style>

</head>

<body>

<!--메인 상단바-->
<div id="wrapper" class="animate">
    <nav class="navbar header-top fixed-top navbar-expand-lg navbar-dark bg-dark">
        <span class="navbar-toggler-icon leftmenutrigger"></span>
        <a class="navbar-brand" href="/main.php"
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
                    <a class="nav-link menu_buskingteam" href="/buskingteam/buskingteam.php" title="Dashboard"><i
                                class="fas fa-users side_bar_img"></i>Busking Team<i
                                class="fas fa-cube shortmenu animate"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu_busking_zone" href="/busking_zone/busking_zone.html" title="Cart"><i
                                class="fas fa-map-marker-alt side_bar_img"></i>Busking Zone<i
                                class="fas fa-cart-plus shortmenu animate"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu_streaming" href="/streaming/streaming.html" title="Comment"><i
                                class="fas fa-video side_bar_img"></i>Streaming<i
                                class="fas fa-comment shortmenu animate"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu_community" href="/community/community.php" title="Comment"><i
                                class="fas fa-star side_bar_img"></i>Community<i
                                class="fas fa-comment shortmenu animate"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu_concert" href="/concert/concert.html" title="Comment"><i
                                class="fas fa-compact-disc side_bar_img"></i>Concert<i
                                class="fas fa-comment shortmenu animate"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-md-auto d-md-flex">
                <li class="nav-item">
                    <a class="nav-link"></a>

                </li>
                <li class="nav-item">
                    <a class="nav-link main_nav_sign" href="/Sign/sign_in.php"><i class="fas fa-key"></i> Sign In</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu_profile" href="#"><i class="fas fa-user"></i> Profile</a>
                </li>
            </ul>
        </div>
    </nav>
</div>

<!-- 로그인 UI -->
<div class="container" style="font-family: 'Numans', sans-serif">
    <div class="d-flex justify-content-center h-100">
        <div class="sign_in_card">
            <div class="card-header">
                <h3>Sign In</h3>
                <div class="d-flex justify-content-end social_icon">
                    <span><i class="fab fa-facebook-square"></i></span>
                    <span><i class="fab fa-google-plus-square"></i></span>
                    <span><i class="fab fa-twitter-square"></i></span>
                </div>
            </div>
            <div class="card-body">
                <form name="login_form" method="post" action="login_check.php">
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="ID" name="ID" id="login_id">

                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" class="form-control" placeholder="password" name="password"
                               id="login_password">
                    </div>
                    <div class="row align-items-center remember">
                        <input type="checkbox" name="auto_sign_in">Remember Me
                    </div>
                    <div class="form-group">
                        <input type="button" value="Sign In" class="btn float-right login_btn" onclick="login()">
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-center links" style="margin-top: 10px">
                    Don't have an account?<a href="sign_up.html" style="margin-left: 20px">Sign Up</a>
                </div>
                <div class="d-flex justify-content-center" style="margin-top: 10px">
                    <a href="forgot_pass.html">Forgot your password?</a>
                </div>
            </div>
        </div>
        <iframe src="" id="login_page" scrolling=no frameborder=no width=0 height=0 name="check_page"></iframe>
    </div>
</div>

<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js"></script>
<script src="../public/side_bar.js"></script>

</body>

</html>