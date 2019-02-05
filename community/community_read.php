<?php
include "../db.php"; /* db load */
session_start();

//조회수 체크 (아이디 & 비로그인 회원 브라우저 체크)

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

        //댓글 작성
        function not_reload_reply(idx, idx_re) {
            var not_reload_reply = $("#not_reload_reply" + idx);
            var params = not_reload_reply.serialize();

            $.ajax({
                type: 'post',
                url: 'commu_reply_p.php',
                data: params,
                dataType: 'html',
                success: function (content) {
                    $(".tlqkf").append(content);
                    $("#reply_input").val("");
                }
            });

        }

        //댓글 수정 다이얼 로그
        function modify_reply(idx) {
            $(".dat_edit").dialog({
                autoOpen: false,
            });
            $("#dat_edit" + idx).dialog("open");
        }

        //댓글 수정 실제 기능
        function modify_reply_click(idx) {

            $("#dat_edit" + idx).dialog("close");

            var dat_delete_click = $("#dat_edit" + idx + "_form");
            var params = dat_delete_click.serialize();

            $.ajax({
                type: 'post',
                url: 'commu_reply_update_p.php',
                data: params,
                dataType: 'html',
                success: function (content) {
                    alert("수정되었습니다.");
                    $("#real_reply_" + idx).text(content);
                }
            });

        }

        //댓글 삭제 다이얼로그
        function delete_reply(idx) {
            $(".dat_delete").dialog({
                autoOpen: false,
            });

            $("#dat_delete" + idx).dialog("open");
        }

        //댓글 삭제 실제 기능
        function dat_delete_click(idx) {

            $("#dat_delete" + idx).dialog("close");

            var dat_delete_click = $("#dat_delete" + idx + "_form");
            var params = dat_delete_click.serialize();

            $.ajax({
                type: 'post',
                url: 'commu_reply_delete_p.php',
                data: params,
                dataType: 'html',
                success: function () {
                    alert("삭제되었습니다.");
                    $("#div" + idx).remove();
                }
            });

        }

        //대댓글 작성
        function not_re_reload_reply(idx) {
            var not_re_reload_reply = $("#sb1" + idx + "_form");
            var params = not_re_reload_reply.serialize();

            $.ajax({
                type: 'post',
                url: 'commu_re_reply_p.php',
                data: params,
                dataType: 'html',
                success: function (re_content) {
                    $("#sb1" + idx).before(re_content);
                    $("#re_reply_input" + idx).val("");
                }
            });

        }

        //대댓글 수정 다이얼로그
        function re_modify_reply(idx) {
            $(".dat_reply_edit").dialog({
                autoOpen: false,
            });
            $("#dat_reply_edit" + idx).dialog("open");
        }

        //대댓글 수정 실제 기능
        function re_modify_reply_click(idx) {

            $("#dat_reply_edit" + idx).dialog("close");

            var dat_delete_click = $("#dat_reply_edit" + idx + "_form");
            var params = dat_delete_click.serialize();

            $.ajax({
                type: 'post',
                url: 'commu_re_reply_update_p.php',
                data: params,
                dataType: 'html',
                success: function (content) {
                    alert("수정되었습니다.");
                    $("#real_re_reply_" + idx).text(content);
                }
            });

        }

        //대댓글 삭제 다이얼로그
        function re_delete_reply(idx) {
            $(".dat_reply_delete").dialog({
                autoOpen: false,
            });
            $("#dat_reply_delete" + idx).dialog("open");
        }

        //대댓글 삭제 실제 기능
        function re_delete_reply_click(idx) {

            $("#dat_reply_delete" + idx).dialog("close");

            var re_delete_reply_click = $("#dat_reply_delete" + idx + "_form");
            var params = re_delete_reply_click.serialize();

            $.ajax({
                type: 'post',
                url: 'commu_re_reply_delete_p.php',
                data: params,
                dataType: 'html',
                success: function () {
                    alert("삭제되었습니다.");
                    $("#re_div" + idx).remove();
                }
            });

        }

        //대댓글 클릭시 버튼 글씨 변경 (댓글 달기 <=> 취소하기)
        function modify_button(idx) {

            var name = "#sb1" + idx;

            if (document.getElementById("sc1" + idx).innerHTML == "댓글달기") {

                $(name).css("display", "block");

                document.getElementById("sc1" + idx).innerHTML = "취소하기";

            } else {

                $(name).css("display", "none");

                document.getElementById("sc1" + idx).innerHTML = "댓글달기";

            }

        }

        //문장 개행 시키기
        function nl2br(str){
            return str.replace(/\n/g, "&#10;");
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
    if (!empty($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
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
                                    <a class="dropdown-item my_font_main" href="community_write.php?idx=' . $board['idx'] . '&page=' . $page . '">수정</a>
                                    <a class="dropdown-item my_font_main" href="community_delete_p.php?idx=' . $board['idx'] . '&page=' . $page . '">삭제</a>';
                                    } else {
                                        echo '<a class="dropdown-item my_font_main" href="/Sign/sign_in.php">로그인하기</a>';
                                    } ?>
                                </div>
                            </div><!--/ dropdown -->
                            <div class="media m-0">
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

                            <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                               data-image=<?php echo $board['picture']; ?>
                               data-target="#image-gallery">
                                <img class="img-thumbnail" style="width: 100%; height: 100%;"
                                     src=<?php echo $board['picture']; ?>>
                            </a>
                        </div><!--/ cardbox-item -->
                        <div class="cardbox-item" style="padding-bottom: 20px">
                            <p class="media-body my_font_main"
                               style="margin-top: 10px; margin-left: 10px; margin-right: 10px;"><?php echo nl2br("$board[content]"); ?></p>

                        </div>


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

                            <div id="div<?= $reply['idx'] ?>">

                                <!--댓글-->
                                <div class="cardbox-comments_re reply_view">
                                    <span class="comment-avatar float-left">
                                        <img class="circle_image" style="margin-top: 5px; width: 30px; height: 30px" src=<?= $write_user['profile']; ?>></span>
                                            <div class="input-group  my_font_main" style="width: 90%; margin-top: 10px; left: 15px">
                                                <span><?php echo $reply['name']; ?>　</span>
                                                <span id="real_reply_<?= $reply['idx'] ?>"><?= nl2br("$reply[content]"); ?></span>
                                                <span style="font-size: 10px; color: #4e555b; position: absolute; right: 0px; margin-top: 5px;"><?= $reply['date']; ?></span>
                                            </div>
                                    <?php
                                    if ($_SESSION != null) {
                                        if ($_SESSION['user_id'] == $reply['pw'] || $_SESSION['user_id'] == "rhksflwk") {

                                            ?>
                                            <div class="rep_me rep_menu my_font_main" style="height: 15px">
                                                <a class="dat_reply_bt color_main btn dat_reply_bt"
                                                   id="sc1<?php echo $reply['idx']; ?>"
                                                   style="font-size: 10px; margin-left: 10px; background-color: transparent"
                                                   onclick="modify_button(<?= $reply['idx']; ?>)">댓글달기</a>

                                                <a class="dat_edit_bt color_main btn dat_edit_bt"
                                                   id="dat_edit_bt<?php echo $reply['idx']; ?>"
                                                   style="font-size: 10px; background-color: transparent"
                                                   onclick="modify_reply(<?php echo $reply['idx']; ?>)">수정</a>
                                                <a class="dat_delete_bt color_main btn dat_delete_bt"
                                                   id="dat_delete_bt<?php echo $reply['idx']; ?>"
                                                   style="font-size: 10px; background-color: transparent;"
                                                   onclick="delete_reply(<?= $reply['idx']; ?>)">삭제</a>
                                            </div>

                                            <?php

                                        } else {

                                            ?>

                                            <div class="rep_me rep_menu my_font_main" style="height: 15px">
                                                <a class="dat_reply_bt color_main btn dat_reply_bt"
                                                   id="sc1<?php echo $reply['idx']; ?>"
                                                   style="font-size: 10px; margin-left: 10px; background-color: transparent"
                                                   onclick="modify_button(<?= $reply['idx']; ?>)">댓글달기</a>
                                            </div>

                                            <?php

                                        }
                                    }
                                    ?>
                                </div>

                                <!-- 댓글 수정 폼 dialog -->
                                <div class="dat_edit" id="dat_edit<?= $reply['idx']; ?>" title="댓글 수정하기">
                                    <form method="post" id="dat_edit<?= $reply['idx']; ?>_form">
                                        <input type="hidden" name="idx" value="<?= $reply['idx']; ?>">
                                        <input type="hidden" name="page" value="<?= $page ?>">
                                        <textarea name="content" class="dap_edit_t form-control"
                                                  style="width: 100%"><?= $reply['content']; ?></textarea>
                                        <input type="button" id="support_hover" value="수정하기"
                                               class="re_mo_bt btn float-right"
                                               style="background-color: #FBAA48; color: white; margin-top: 10px" onclick="modify_reply_click(<?= $reply['idx']; ?>)">
                                    </form>
                                </div>

                                <!-- 댓글 삭제 폼 dialog -->
                                <div class="dat_delete" id="dat_delete<?= $reply['idx']; ?>" title="댓글 삭제하기">
                                    <form method="post" style="margin-top: 16px;"
                                          id="dat_delete<?php echo $reply['idx']; ?>_form"
                                          action="commu_reply_delete_p.php?idx=<?php echo $reply['idx']; ?>&now_idx=<?php echo $bno; ?>">
                                        <input type="hidden" name="idx" value="<?= $reply['idx'] ?>">
                                        <input type="hidden" name="now_idx" value="<?= $bno ?>">
                                        <input type="hidden" name="page" value="<?= $page ?>">
                                        <input type="button" id="support_hover" value="삭제하기"
                                               class="re_mo_bt btn float-left"
                                               style="background-color: #FBAA48; color: white; width: 100%"
                                               onclick="dat_delete_click(<?= $reply['idx']; ?>)">
                                    </form>
                                </div>

                                <!--- 대댓글 불러오기 -->
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

                                    <div id="re_div<?= $re_reply['idx'] ?>">

                                        <div style="width: 93%; margin-left:6%; margin-top: 10px;">
                                            <!-- 대댓글 수정 폼 dialog -->
                                            <div class="dat_reply_edit" id="dat_reply_edit<?= $re_reply['idx']; ?>" title="댓글 수정하기">
                                                <form method="post" id="dat_reply_edit<?php echo $re_reply['idx']; ?>_form">
                                                    <textarea name="content" class="dap_edit_t form-control" style="width: 100%"><?= $re_reply['content']; ?></textarea>
                                                    <input type="hidden" name="idx" value="<?= $re_reply['idx']; ?>">
                                                    <input type="hidden" name="page" value="<?= $page ?>">
                                                    <input type="button" id="support_hover" value="수정하기" class="re_mo_bt btn float-right"
                                                           style="background-color: #FBAA48; color: white; margin-top: 10px" onclick="re_modify_reply_click(<?= $re_reply['idx']; ?>)">
                                                </form>
                                            </div>

                                            <!-- 댓글 삭제 폼 dialog -->
                                            <div class="dat_reply_delete"
                                                 id="dat_reply_delete<?php echo $re_reply['idx'] ?>"
                                                 title="댓글 삭제하기">
                                                <form method="post" style="margin-top: 16px;"
                                                      id="dat_reply_delete<?php echo $re_reply['idx'] ?>_form"
                                                      action="commu_re_reply_delete_p.php">
                                                    <input type="hidden" name="idx" value="<?= $re_reply['idx'] ?>">
                                                    <input type="hidden" name="now_idx" value="<?= $bno ?>">
                                                    <input type="hidden" name="page" value="<?= $page ?>">
                                                    <input type="button" id="support_hover" value="삭제하기"
                                                           class="re_mo_bt btn float-left"
                                                           style="background-color: #FBAA48; color: white; width: 100%"
                                                           onclick="re_delete_reply_click(<?= $re_reply['idx'] ?>)">
                                                </form>
                                            </div>

                                            <!--댓글-->
                                            <div class="cardbox-comments_re reply_view"><span
                                                        class="comment-avatar float-left">
                                                        <img class="circle_image"
                                                             style="margin-top:5px; width:30px; height:30px"
                                                             src=<?php echo $write_user['profile']; ?>></span>
                                                <div class="input-group  my_font_main"
                                                     style="width: 90%; margin-top: 10px; left: 15px">
                                                    <span><?= $re_reply['name']; ?>　</span>
                                                    <span id="real_re_reply_<?= $re_reply['idx'] ?>"><?= nl2br("$re_reply[content]"); ?></span>
                                                    <span style="font-size: 10px; color: #4e555b; position: absolute; right: 0px; margin-top: 5px; margin-right: -5px"><?php echo $re_reply['date']; ?></span>
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

                                    </div>

                                    <?php
                                }

                                ?>
                                <div id="sb1<?php echo $reply['idx']; ?>"
                                     style="display:none; width: 90%; margin-left: 52px!important; margin-top: 15px">
                                    <span class="comment-avatar float-left"><img class="rounded-circle" src="<?= $_SESSION['profile'] ?>" style="margin-top: 5px; width: 30px; height: 30px"></span>
                                    <form method="post" class="re_reply_form" id="sb1<?php echo $reply['idx']; ?>_form">
                                        <div class="input-group input-group-sm my_font_main" style="width: 90%;height: 40px; margin-top: 5px; left: 15px">
                                            <input type="hidden" name="idx" value="<?php echo $reply['idx']; ?>">
                                            <input type="hidden" name="now_idx" value="<?php echo $bno; ?>">
                                            <input type="hidden" id="re_reply_bno" name="bno" value="<?= $bno ?>">
                                            <input type="hidden" name="re_page" value="<?= $page ?>">
                                            <input type="text" name="re_reply_content"
                                                   class="form-control col-sm-10 reply_content"
                                                   aria-label="Sizing example input" id="re_reply_input<?php echo $reply['idx']; ?>"
                                                   aria-describedby="inputGroup-sizing-sm" placeholder="댓글을 작성해주세요 :)">
                                            <button type="button" class="col-sm-2 btn" style="left: 10px; background-color: #FBAA48; color: white"
                                                    id="support_1" onclick="not_re_reload_reply(<?= $reply['idx']; ?>)">댓글 달기
                                            </button>
                                        </div>
                                    </form>
                                </div>

                            </div>

                            <?php

                        } ?>


                    </div>

                    <?php
                    } ?>

                    <?php if ($_SESSION != null) {
                        ?>
                        <div class="cardbox-comments"><span class="comment-avatar float-left"><img
                                        class="rounded-circle"
                                        src='<?= $_SESSION['profile'] ?>'
                                        alt="..." style="margin-top: 5px"></span>

                            <form method="post" class="reply_form" id="not_reload_reply<?= $bno ?>">
                                <div class="input-group input-group-sm mb-3 my_font_main"
                                     style="width: 90%;height: 40px; margin-top: 5px; left: 15px">
                                    <input type="hidden" id="reply_bno" name="con_num" value="<?= $bno ?>">
                                    <input type="text" name="reply_content" class="form-control col-sm-10 reply_content"
                                           aria-label="Sizing example input" id="reply_input"
                                           aria-describedby="inputGroup-sizing-sm" placeholder="댓글을 작성해주세요 :)">
                                    <button type="button" class="col-sm-2 btn re_bt"
                                            style="left: 10px; background-color: #FBAA48; color: white"
                                            id="support_1<?= $bno ?>" onclick="not_reload_reply(<?= $bno ?>,<?= $reply['idx'] ?>)">댓글 달기
                                    </button>
                                </div>
                            </form>
                        </div>
                        <?php
                    } else {

                    } ?>

                </div>

            </div>

        </div>

        <a href="/community/community.php?page=<?= $page ?>" style="margin-left: 465px; ">
            <button class="col-sm-2 btn my_font_main"
                    style="font-size: 18px; margin-top: 30px; background-color: #FBAA48; color: white" id="support_1">목록으로
            </button>
        </a>

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