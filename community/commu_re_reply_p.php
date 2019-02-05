<?php

include "../db.php";

session_start();

$bno = $_POST['idx'];
$go = $_POST['now_idx'];
$re_content = $_POST['re_reply_content'];

$sql = mq("insert into commu_re_reply_tb(con_num, name, pw, content) values ('" . $bno . "', '" . $_SESSION['name'] . "', '" . $_SESSION['user_id'] . "','" . $re_content . "')");

$sql_re = mq("select last_insert_id()");

$insert_idx = $sql_re->fetch_array();

$sql_re_re = mq("select * from commu_re_reply_tb where idx = '" . $insert_idx[0] . "'");

$re_reply = $sql_re_re->fetch_array();

echo '<div id="re_div' . $re_reply['idx'] . '">

            <div style="width: 93%;margin-left:6%;margin-top: 10px;">
                <!-- 대댓글 수정 폼 dialog -->
                <div class="dat_reply_edit" id="dat_reply_edit' . $re_reply['idx'] . '" title="댓글 수정하기">
                    <form method="post" id="dat_reply_edit' . $re_reply['idx'] . '_form">
                        <textarea name="content" class="dap_edit_t form-control" style="width: 100%">' . $re_reply['content'] . '</textarea>
                        <input type="hidden" name="idx" value="' . $re_reply['idx'] . '">
                        <input type="button" id="support_hover" value="수정하기" class="re_mo_bt btn float-right"
                               style="background-color: #FBAA48; color: white; margin-top: 10px" onclick="re_modify_reply_click(' . $re_reply['idx'] . ')">
                    </form>
                </div>
    
                <!-- 댓글 삭제 폼 dialog -->
                <div class="dat_reply_delete"
                     id="dat_reply_delete' . $re_reply['idx'] . '"
                     title="댓글 삭제하기">
                    <form method="post" style="margin-top: 16px;"
                          id="dat_reply_delete' . $re_reply['idx'] . '_form"
                          action="commu_re_reply_delete_p.php">
                        <input type="hidden" name="idx" value="' . $re_reply['idx'] . '">
                        <input type="hidden" name="now_idx" value="' . $bno . '">
                        <input type="button" id="support_hover" value="삭제하기"
                               class="re_mo_bt btn float-left"
                               style="background-color: #FBAA48; color: white; width: 100%"
                               onclick="re_delete_reply_click(' . $re_reply['idx'] . ')">
                    </form>
                </div>
    
                <!--댓글-->
                <div class="cardbox-comments_re reply_view"><span
                            class="comment-avatar float-left">
                            <img class="circle_image"
                                 style="margin-top:5px; width:30px; height:30px"
                                 src=' . $_SESSION['profile'] . '></span>
                    <div class="input-group  my_font_main"
                         style="width: 90%; margin-top: 10px; left: 15px">
                        <span>' . $re_reply['name'] . '　</span>
                        <span id="real_re_reply_' . $re_reply['idx'] . '">' . nl2br("$re_reply[content]") . '</span>
                        <span style="font-size: 10px; color: #4e555b; position: absolute; right: 0px; margin-top: 5px; margin-right: -5px">' . $re_reply['date'] . '</span>
                    </div>

                            <div class="rep_me rep_menu my_font_main" style="height: 15px">
                                <a class="reply_dat_edit_bt color_main btn"
                                   id="reply_dat_edit_bt' . $re_reply['idx'] . '"
                                   style="font-size: 10px; background-color: transparent"
                                   onclick="re_modify_reply(' . $re_reply['idx'] . ')">수정</a>
                                <a class="reply_dat_delete_bt color_main btn"
                                   id="reply_dat_delete_bt' . $re_reply['idx'] . '"
                                   style="font-size: 10px; background-color: transparent;"
                                   onclick="re_delete_reply(' . $re_reply['idx'] . ')">삭제</a>
                            </div>

                </div>

            </div>

        </div>';

?>
