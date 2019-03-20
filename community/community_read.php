<?php
include "../db.php"; /* db load */
session_start();

$bno = $_GET['idx']; /* bno함수에 idx값을 받아와 넣음*/
if ($_SESSION != null) {
    if (empty($_COOKIE['community' . $_SESSION['user_id'] . $bno])) {
        setcookie('community' . $_SESSION['user_id'] . $bno, TRUE, time() + (60 * 60 * 24), '/');

        $hit = mysqli_fetch_array(mq("select * from community_tb where idx ='" . $bno . "'"));
        $hit = $hit['hit'] + 1;
        $fet = mq("update community_tb set hit = '" . $hit . "' where idx = '" . $bno . "'");
    }
} else {
    if (empty($_COOKIE['community' . "guest" . $bno])) {
        setcookie('community' . "guest" . $bno, TRUE, time() + (60 * 60 * 24), '/');

        $hit = mysqli_fetch_array(mq("select * from community_tb where idx ='" . $bno . "'"));
        $hit = $hit['hit'] + 1;
        $fet = mq("update community_tb set hit = '" . $hit . "' where idx = '" . $bno . "'");
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
    <link href="community_read.css" rel="stylesheet">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!------ Include the above in your HEAD tag ---------->
    <link href="https://fonts.googleapis.com/css?family=Rokkitt" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="community_read.css" rel="stylesheet">

    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js"></script>


    <style>
        .menu_community {
            color: #FBAA48 !important;
        }

    </style>

    <script>

        function re_reply(idx) {
            $(".dat_reply").dialog({
                autoOpen: false,
            });
            $("#dat_reply_bt" + idx).on("click", function () {
                $("#dat_reply" + idx).dialog("open");
            });
        };

        function re_modify_reply(idx) {
            $(".dat_reply_edit").dialog({
                autoOpen: false,
            });
            $("#reply_dat_edit_bt" + idx).on("click", function () {
                $("#dat_reply_edit" + idx).dialog("open");
            });
        };

        function re_delete_reply(idx) {
            $(".dat_reply_delete").dialog({
                autoOpen: false,
            });
            $("#reply_dat_delete_bt" + idx).on("click", function () {
                $("#dat_reply_delete" + idx).dialog("open");
            });
        };

        function modify_reply(idx) {
            $(".dat_edit").dialog({
                autoOpen: false,
            });
            $("#dat_edit_bt" + idx).on("click", function () {
                $("#dat_edit" + idx).dialog("open");
            });
        };

        function delete_reply(idx) {
            $(".dat_delete").dialog({
                autoOpen: false,
            });
            $("#dat_delete_bt" + idx).on("click", function () {
                $("#dat_delete" + idx).dialog("open");
            });
        };

        $(document).ready(function () {

            $(".re_bt").click(function () {
                var params = $("form").serialize();
                var index = document.getElementById("reply_bno").value;
                $.ajax({
                    type: 'post',
                    url: '/community/commu_reply_p.php?idx=' + index + '',
                    data: params,
                    dataType: 'html',
                    success: function (data) {
                        $(".reply_view").html(data);
                        $(".reply_content").val('');
                    }
                });

            });

        });

        function st1(idx) {

            var name = "#sb1" + idx;

            console.log(name);

            if (document.getElementById("sc1" + idx).innerHTML == "댓글달기") {

                $(name).css("display", "block");

                document.getElementById("sc1" + idx).innerHTML = "취소하기";

            } else {

                $(name).css("display", "none");

                document.getElementById("sc1" + idx).innerHTML = "댓글달기";

            }

        }

    </script>

</head>
<body>

<div class="container">

    <h1 class="mt-4 mb-3 my_font_index">Community</h1>

    <h6 class="my_font_main">※ 깨끗한 인터넷 문화를 만들어갑시다. :)</h6>

    <!--header 로드-->
    <div class="main_nav"></div>
    <script>$(".main_nav").load("/public/main_nav.php");</script>

    <?php
    $sql = mq("select * from community_tb where idx='" . $bno . "'"); /* 받아온 idx값을 선택 */
    $board = $sql->fetch_array();
    ?>

    <section class="hero">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 offset-lg-2">

                    <div class="cardbox shadow-lg bg-white">

                        <div class="cardbox-heading">
                            <!-- START dropdown-->
                            <div class="dropdown float-right">
                                <button class="btn btn-flat btn-flat-icon" type="button" data-toggle="dropdown"
                                        aria-expanded="false">
                                    <em class="fa fa-ellipsis-h"></em>
                                </button>
                                <div class="dropdown-menu dropdown-scale dropdown-menu-right" role="menu"
                                     style="position: absolute; transform: translate3d(-136px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    <?php if ($_SESSION != null) {
                                        echo '
                                    <a class="dropdown-item" href="community_write.php?idx=' . $board['idx'] . '">수정</a>
                                    <a class="dropdown-item" href="community_delete_p.php?idx=' . $board['idx'] . '">삭제</a>';
                                    } else {
                                        echo '<a class="dropdown-item" href="/Sign/sign_in.php">로그인하기</a>';
                                    } ?>
                                </div>
                            </div><!--/ dropdown -->
                            <div class="media m-0">
                                <!--<div class="d-flex mr-3">-->
                                <!--<a href=""><img class="img-fluid rounded-circle" src="http://www.themashabrand.com/templates/bootsnipp/post/assets/img/users/4.jpg" alt="User"></a>-->
                                <!--</div>-->
                                <div class="media-body">
                                    <p class="m-0 color_point my_font_start"
                                       style="font-size: 24px"><?php echo $board['title']; ?></p>
                                    <small><span class="float-left" style="position: relative;left: -10px; top: 20px"><i
                                                    class="icon ion-md-time"></i> 조회수 : <?php echo $board['hit']; ?></span>
                                    </small>
                                    <small><span class="float-right" style="position: relative;left: 50px; top: 20px"><i
                                                    class="icon ion-md-time"></i> <?php echo $board['date']; ?></span>
                                    </small>
                                    <small><span class="float-right" style="position: relative;left: 50px; top: 20px"><i
                                                    class="icon ion-md-pin"></i> <?php echo $board['name']; ?></span>
                                    </small>
                                </div>
                            </div><!--/ media -->
                        </div><!--/ cardbox-heading -->

                        <div class="cardbox-item" style=" padding: 5px 5px 5px 5px">
                            <!--<img class="img-fluid"-->
                            <!--src="http://www.themashabrand.com/templates/bootsnipp/post/assets/img/1.jpg"-->
                            <!--alt="Image">-->

                            <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                               data-image=<?php echo $board['picture']; ?>
                               data-target="#image-gallery">
                                <img class="img-thumbnail" style="width: 100%; height: 100%;"
                                     src=<?php echo $board['picture']; ?> alt="Another alt text">
                            </a>
                        </div><!--/ cardbox-item -->
                        <div class="cardbox-item" style="padding-bottom: 20px">
                            <p class="media-body my_font_main"
                               style="margin-top: 10px; margin-left: 10px; margin-right: 10px;"><?php echo nl2br("$board[content]"); ?></p>

                        </div>

                        <!--                        좋아용-->
                        <!--                        <ul class="cardbox-base">-->
                        <!---->
                        <!--                            <ul class="float-right">-->
                        <!--                                <li><a><i class="far fa-comment"></i></a></li>-->
                        <!--                                <li><a><em class="mr-5"> 12</em></a></li>-->
                        <!--                                <li><a><i class="fa fa-share-alt"></i></a></li>-->
                        <!--                                <li><a><em class="mr-3">03</em></a></li>-->
                        <!--                            </ul>-->
                        <!--                            <ul>-->
                        <!--                                <li><a><i class="fa fa-thumbs-up"></i></a></li>-->
                        <!--                                <li><a href="#"><img src="../img/main_cover_01.jpg" class="img-fluid rounded-circle"-->
                        <!--                                                     alt="User"></a></li>-->
                        <!--                                <li><a href="#"><img src="../img/main_cover_02.jpg" class="img-fluid rounded-circle"-->
                        <!--                                                     alt="User"></a></li>-->
                        <!--                                <li><a href="#"><img src="../img/main_cover_03.jpg" class="img-fluid rounded-circle"-->
                        <!--                                                     alt="User"></a></li>-->
                        <!--                                <li><a href="#"><img src="../img/login_background.jpg" class="img-fluid rounded-circle"-->
                        <!--                                                     alt="User"></a></li>-->
                        <!--                                <li><a><span>10 Likes</span></a></li>-->
                        <!--                            </ul>-->
                        <!--                        </ul>-->

                        <!-- 댓글 시작 -->
                        <hr>

                        <?php
                        $sql3 = mq("select * from commu_reply_tb where con_num='" . $bno . "' order by idx ASC");
                        if ($reply = $sql3->fetch_array()){ ?>

                        <h6 class="my_font_main" style="margin-left: 10px">댓글</h6>

                        <?php

                        if ($_SESSION != null) {
                            echo '<div class="tlqkf">';
                        } else {
                            echo '<div class="tlqkf" style="padding-bottom: 20px">';
                        }

                        ?>

                        <!--- 댓글 불러오기 -->
                        <?php
                        $sql3 = mq("select * from commu_reply_tb where con_num='" . $bno . "' order by idx ASC");
                        while ($reply = $sql3->fetch_array()) {
                            // 프사 넣는 쿼리
                            $sql = 'SELECT * FROM user_info_tb WHERE user_id=\'' . $reply['pw'] . '\'';

                            // DB 에 쿼리 날리기
                            $result = mysqli_query($conn, $sql);

                            // 쿼리 결과를 PHP 에서 사용할 수 있도록 변경
                            $write_user = mysqli_fetch_assoc($result);

                            ?>

                            <!--답글달기-->
                            <div class="dat_reply" id="dat_reply<?php echo $reply['idx']; ?>" title="댓글달기">
                                <form method="post"
                                      action="commu_re_reply_p.php?idx=<?php echo $reply['idx']; ?>&now_idx=<?php echo $bno; ?>">
                                        <textarea name="re_reply_content" class="dap_edit_t form-control"
                                                  style="width: 100%"></textarea>
                                    <input type="submit" id="support_hover" value="댓글달기"
                                           class="re_mo_bt btn float-right"
                                           style="background-color: #FBAA48; color: white; margin-top: 10px">
                                </form>
                            </div>

                            <!-- 댓글 수정 폼 dialog -->
                            <div class="dat_edit" id="dat_edit<?php echo $reply['idx']; ?>" title="댓글 수정하기">
                                <form method="post"
                                      action="commu_reply_update_p.php?idx=<?php echo $reply['idx']; ?>&now_idx=<?php echo $bno; ?>">
                                        <textarea name="content" class="dap_edit_t form-control"
                                                  style="width: 100%"><?php echo $reply['content']; ?></textarea>
                                    <input type="submit" id="support_hover" value="수정하기"
                                           class="re_mo_bt btn float-right"
                                           style="background-color: #FBAA48; color: white; margin-top: 10px">
                                </form>
                            </div>

                            <!-- 댓글 삭제 폼 dialog -->
                            <div class="dat_delete" id="dat_delete<?php echo $reply['idx']; ?>" title="댓글 삭제하기">
                                <form method="post" style="margin-top: 16px;"
                                      action="commu_reply_delete_p.php?idx=<?php echo $reply['idx']; ?>&now_idx=<?php echo $bno; ?>">
                                    <input type="submit" id="support_hover" value="삭제하기" class="re_mo_bt btn float-left"
                                           style="background-color: #FBAA48; color: white; width: 100%">
                                </form>
                            </div>

                            <!--댓글-->
                            <div class="cardbox-comments_re reply_view"><span class="comment-avatar float-left">
                                <a href=""><img class="circle_image"
                                                src=<?php echo $write_user['profile']; ?> alt="..."
                                                style="margin-top: 5px; width: 30px; height: 30px"></a></span>
                                <div class="input-group  my_font_main"
                                     style="width: 90%; margin-top: 10px; left: 15px">
                                    <span><?php echo $reply['name']; ?>　</span>
                                    <span><?php echo nl2br("$reply[content]"); ?></span>
                                    <span style="font-size: 10px; color: #4e555b; position: absolute; right: 0px; margin-top: 5px;">
                                    <?php echo $reply['date']; ?></span>
                                </div>
                                <?php
                                if ($_SESSION != null) {
                                    if ($_SESSION['user_id'] == $reply['pw'] || $_SESSION['user_id'] == "rhksflwk") {

                                        ?>
                                        <div class="rep_me rep_menu my_font_main" style="height: 15px">
                                            <a class="dat_reply_bt color_main btn dat_reply_bt"
                                               id="sc1<?php echo $reply['idx']; ?>"
                                               style="font-size: 10px; margin-left: 10px; background-color: transparent"
                                               onclick="st1(<?= $reply['idx']; ?>)">댓글달기</a>

                                            <a class="dat_edit_bt color_main btn dat_edit_bt"
                                               id="dat_edit_bt<?php echo $reply['idx']; ?>"
                                               style="font-size: 10px; background-color: transparent"
                                               onclick="modify_reply(<?php echo $reply['idx']; ?>)">수정</a>
                                            <a class="dat_delete_bt color_main btn dat_delete_bt"
                                               id="dat_delete_bt<?php echo $reply['idx']; ?>"
                                               style="font-size: 10px; background-color: transparent;"
                                               onclick="delete_reply(<?php echo $reply['idx']; ?>)">삭제</a>
                                        </div>
                                        <?php
                                    } else {

                                        ?>

                                        <div class="rep_me rep_menu my_font_main" style="height: 15px">
                                            <a class="dat_reply_bt color_main btn dat_reply_bt"
                                               id="dat_reply_bt<?php echo $reply['idx']; ?>"
                                               style="font-size: 10px; margin-left: 10px; background-color: transparent"
                                               onclick="re_reply(<?php echo $reply['idx']; ?>)">답글</a>
                                        </div>

                                        <?php

                                    }
                                }
                                ?>
                            </div>

                            <!--- 댓글 불러오기 -->
                            <?php
                            $sql4 = mq("select * from commu_re_reply_tb where con_num='" . $reply['idx'] . "' order by idx ASC");

                            while ($re_reply = $sql4->fetch_array()) {

                                // 프사 넣는 쿼리
                                $sql = 'SELECT * FROM user_info_tb WHERE user_id=\'' . $re_reply['pw'] . '\'';

                                // DB 에 쿼리 날리기
                                $result = mysqli_query($conn, $sql);

                                // 쿼리 결과를 PHP 에서 사용할 수 있도록 변경
                                $write_user = mysqli_fetch_assoc($result);

                                ?>

                                <div style="width: 93%; margin-left:6%; margin-top: 10px;">
                                    <!-- 댓글 수정 폼 dialog -->
                                    <div class="dat_reply_edit" id="dat_reply_edit<?php echo $re_reply['idx']; ?>"
                                         title="댓글 수정하기">
                                        <form method="post"
                                              action="commu_re_reply_update_p.php?idx=<?php echo $re_reply['idx']; ?>&now_idx=<?php echo $bno; ?>">
                                        <textarea name="content" class="dap_edit_t form-control"
                                                  style="width: 100%"><?php echo $re_reply['content']; ?></textarea>
                                            <input type="hidden" name="page" value="<?= $_GET['page'] ?>">
                                            <input type="submit" id="support_hover" value="수정하기"
                                                   class="re_mo_bt btn float-right"
                                                   style="background-color: #FBAA48; color: white; margin-top: 10px">
                                        </form>
                                    </div>

                                    <!-- 댓글 삭제 폼 dialog -->
                                    <div class="dat_reply_delete" id="dat_reply_delete<?php echo $re_reply['idx']; ?>"
                                         title="댓글 삭제하기">
                                        <form method="post" style="margin-top: 16px;"
                                              action="commu_re_reply_delete_p.php?idx=<?php echo $re_reply['idx']; ?>&now_idx=<?php echo $bno; ?>">
                                            <input type="submit" id="support_hover" value="삭제하기"
                                                   class="re_mo_bt btn float-left"
                                                   style="background-color: #FBAA48; color: white; width: 100%">
                                        </form>
                                    </div>

                                    <!--댓글-->
                                    <div class="cardbox-comments_re reply_view"><span class="comment-avatar float-left">
                                <a href=""><img class="circle_image"
                                                src=<?php echo $write_user['profile']; ?> alt="..."
                                                style="margin-top: 5px; width: 30px; height: 30px"></a></span>
                                        <div class="input-group  my_font_main"
                                             style="width: 90%; margin-top: 10px; left: 15px">
                                                            <span>
                            <?php echo $re_reply['name']; ?>　</span>
                                            <span>
                            <?php echo nl2br("$re_reply[content]"); ?></span>
                                            <span style="font-size: 10px; color: #4e555b; position: absolute; right: 0px; margin-top: 5px; margin-right: 5px">
                                     <?php echo $re_reply['date']; ?></span>
                                        </div>

                                        <?php
                                        if ($_SESSION != null) {
                                            if ($_SESSION['user_id'] == $re_reply['pw'] || $_SESSION['user_id'] == "rhksflwk") {

                                                ?>
                                                <div class="rep_me rep_menu my_font_main" style="height: 15px">
                                                    <a class="reply_dat_edit_bt color_main btn"
                                                       id="reply_dat_edit_bt<?php echo $re_reply['idx']; ?>"
                                                       style="font-size: 10px; background-color: transparent"
                                                       onclick="re_modify_reply(<?php echo $re_reply['idx']; ?>)">수정</a>
                                                    <a class="reply_dat_delete_bt color_main btn"
                                                       id="reply_dat_delete_bt<?php echo $re_reply['idx']; ?>"
                                                       style="font-size: 10px; background-color: transparent;"
                                                       onclick="re_delete_reply(<?php echo $re_reply['idx']; ?>)">삭제</a>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>

                                    </div>


                                </div>

                                <?php
                            }

                            ?>
                            <div id="sb1<?php echo $reply['idx']; ?>"
                                 style="display:none; width: 90%; margin-left: 60px">
                                    <span class="comment-avatar float-left"><a href="">
                                            <img class="rounded-circle"
                                                 src="<?= $_SESSION['profile'] ?>"
                                                 style="margin-top: 5px; width: 30px; height: 30px"></a></span>
                                <form method="post" class="re_reply_form" action="commu_re_reply_p.php?idx=<?php echo $reply['idx']; ?>&now_idx=<?php echo $bno; ?>">
                                    <div class="input-group input-group-sm my_font_main"
                                         style="width: 90%;height: 40px; margin-top: 5px; left: 15px">
                                        <input type="hidden" id="re_reply_bno" name="bno" value="' . $bno . '">
                                        <input type="hidden" name="page" value="<?= $_GET['page'] ?>">
                                        <input type="text" name="re_reply_content"
                                               class="form-control col-sm-10 reply_content"
                                               aria-label="Sizing example input"
                                               aria-describedby="inputGroup-sizing-sm" placeholder="댓글을 작성해주세요 :)">
                                        <button type="suid=" rep_bt class="col-sm-2 btn"
                                                style="left: 10px; background-color: #FBAA48; color: white"
                                                id="support_1">댓글 달기
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <?php

                        } ?>


                    </div>


                    <?php
                    } ?>

                    <?php if ($_SESSION != null) {
                        echo ' <div class="cardbox-comments"><span class="comment-avatar float-left"><a href=""><img class="rounded-circle"
                               src=' . $_SESSION['profile'] . '
                               alt="..." style="margin-top: 5px"></a></span>
                        
                                        <form method="post" class="reply_form">
                                            <div class="input-group input-group-sm mb-3 my_font_main"
                                                 style="width: 90%;height: 40px; margin-top: 5px; left: 15px">
                                    			<input type="hidden" id="reply_bno" name="bno" value="' . $bno . '">
                                                <input type="text" name="reply_content" class="form-control col-sm-10 reply_content" aria-label="Sizing example input"
                                                       aria-describedby="inputGroup-sizing-sm" placeholder="댓글을 작성해주세요 :)">
                                                <button type="suid="rep_bt class="col-sm-2 btn re_bt"
                                                       style="left: 10px; background-color: #FBAA48; color: white" id="support_1">댓글 달기</button>
                                            </div>
                                        </form>    
                                 </div>';
                    } else {

                    } ?>


                </div><!--/ cardbox-like -->

            </div>

        </div><!--/ col-lg-6 -->

</div><!--/ row -->

<a href="/community/community.php?page=<?= $_GET['page'] ?>" style="margin-left: 465px; ">
    <button class="col-sm-2 btn" style="margin-top: 30px; background-color: #FBAA48; color: white"
            id="support_1">목록으로
    </button>
</a>

</div><!--/ container -->
</section>
</div>

<div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header my_font_main"><?php echo $board['title']; ?>
                <h4 class="modal-title" id="image-gallery-title"></h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="image-gallery-image" class="img-responsive col-md-12" src="">
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<!--footer 로드-->
<div class="main_footer"></div>
<script>$(".main_footer").load("/public/main_footer.html");</script>

<!-- Bootstrap core JavaScript -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!--<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js"></script>-->
<script src="../public/side_bar.js"></script>
<script src="community.js"></script>
<script src="read_view.js"></script>

</body>