<?php
session_start();
?>

<!--사이드바-->
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
                    <a class="nav-link menu_streaming" href="/streaming/streaming.html" title="Comment"><i class="fas fa-video side_bar_img"></i>Streaming<i
                            class="fas fa-comment shortmenu animate"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu_community" href="/community/community.php" title="Comment"><i class="fas fa-star side_bar_img"></i>Community<i
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
                    <?php if ($_SESSION == null) {
                        echo '<a class="nav-link"></a>';
                    } else {
                        echo '<a class="nav-link">'.$_SESSION['name'] . " 님" . '</a>';
                    } ?>

                </li>
                <li class="nav-item">
                    <?php if ($_SESSION == null) {
                        echo '<a class="nav-link main_nav_sign" href="/Sign/sign_in.php"><i class="fas fa-key"></i> Sign In</a>';
                    } else {
                        echo '<a class="nav-link main_nav_sign" href="/Sign/sign_out.php"><i class="fas fa-key"></i> Sign Out</a>';
                    } ?>
                </li>

                <?php
                if ($_SESSION['user_id'] == "rhksflwk") {

                    ?>

                    <li class="nav-item">
                        <a class="nav-link menu_profile" href="/my_page/my_page_modify.php"><i class="fas fa-crown"></i> Manager Page</a>
                    </li>

                    <?php

                } else {

                    ?>

                    <li class="nav-item">
                        <a class="nav-link menu_profile" href="/my_page/my_page_modify.php"><i class="fas fa-user"></i> My Page</a>
                    </li>

                    <?php

                }
                ?>

            </ul>
        </div>
    </nav>
</div>