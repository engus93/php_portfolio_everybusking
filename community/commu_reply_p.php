<?php

include "../db.php";

session_start();

$bno = $_POST['con_num'];
$content = $_POST['reply_content'];

$sql = mq("insert into commu_reply_tb(con_num, name, pw, content) values ('" . $bno . "', '" . $_SESSION['name'] . "', '" . $_SESSION['user_id'] . "','" . $content . "')");

$sql_re = mq("select last_insert_id()");

$insert_idx = $sql_re->fetch_array();

$sql_re_re = mq("select * from commu_reply_tb where idx = '" . $insert_idx[0] . "'");

$reply = $sql_re_re->fetch_array();

echo '<div id="div' . $insert_idx[0] . '">
            <div class="cardbox-comments_re reply_view">
                    <span class="comment-avatar float-left">
                        <img class="circle_image" style="margin-top: 5px; width: 30px; height: 30px" src=' . $_SESSION['profile'] . '>
                    </span>
                    <div class="input-group  my_font_main" style="width: 90%; margin-top: 10px; left: 15px">
                        <span>' . $reply['name'] . '　</span>
                        <span id="real_reply_' . $reply['idx'] . '">' . nl2br("$reply[content]") . '</span>
                        <span style="font-size: 10px; color: #4e555b; position: absolute; right: 0px; margin-top: 5px;">' . $reply['date'] . '</span>
                    </div>
                    
                    <div class="rep_me rep_menu my_font_main" style="height: 15px">
                            <a class="dat_reply_bt color_main btn dat_reply_bt"
                               id="sc1' . $reply['idx'] . '"
                               style="font-size: 10px; margin-left: 10px; background-color: transparent"
                               onclick="modify_button(' . $reply['idx'] . ')">댓글달기</a>
                            <a class="dat_edit_bt color_main btn dat_edit_bt"
                               id="dat_edit_bt' . $reply['idx'] . '"
                               style="font-size: 10px; background-color: transparent"
                               onclick="modify_reply(' . $reply['idx'] . ')">수정</a>
                            <a class="dat_delete_bt color_main btn dat_delete_bt"
                               id="dat_delete_bt' . $reply['idx'] . '"
                               style="font-size: 10px; background-color: transparent;"
                               onclick="delete_reply(' . $reply['idx'] . ')">삭제</a>
                    </div>
                
            </div>

            <!-- 댓글 수정 폼 dialog -->
            <div class="dat_edit" id="dat_edit' . $reply['idx'] . '" title="댓글 수정하기">
                <form method="post" id="dat_edit' . $reply['idx'] . '_form">
                    <input type="hidden" name="idx" value="' . $reply['idx'] . '">
                    <textarea name="content" class="dap_edit_t form-control"
                              style="width: 100%">' . $reply['content'] . '</textarea>
                    <input type="button" id="support_hover" value="수정하기"
                           class="re_mo_bt btn float-right"
                           style="background-color: #FBAA48; color: white; margin-top: 10px" onclick="modify_reply_click(' . $reply['idx'] . ')">
                </form>
            </div>

            <!-- 댓글 삭제 폼 dialog -->
            <div class="dat_delete" id="dat_delete' . $reply['idx'] . '" title="댓글 삭제하기">
                <form method="post" style="margin-top: 16px;"
                      id="dat_delete' . $reply['idx'] . '_form">
                    <input type="hidden" name="idx" value="' . $reply['idx'] . '">
                    <input type="hidden" name="now_idx" value="' . $bno . '">
                    <input type="button" id="support_hover" value="삭제하기"
                           class="re_mo_bt btn float-left"
                           style="background-color: #FBAA48; color: white; width: 100%"
                           onclick="dat_delete_click(' . $reply["idx"] . ')">
                </form>
            </div>

            <div id="sb1' . $reply['idx'] . '"
                 style="display:none; width: 90%; margin-left: 52px!important; margin-top: 15px">
                <span class="comment-avatar float-left"><img class="rounded-circle" src="' . $_SESSION['profile'] . '" style="margin-top: 5px; width: 30px; height: 30px"></span>
                <form method="post" class="re_reply_form" id="sb1' . $reply['idx'] . '_form">
                    <div class="input-group input-group-sm my_font_main" style="width: 90%;height: 40px; margin-top: 5px; left: 15px">
                        <input type="hidden" name="idx" value="' . $reply['idx'] . '">
                        <input type="hidden" name="now_idx" value="' . $bno . '">
                        <input type="hidden" id="re_reply_bno" name="bno" value="' . $bno . '">
                        <input type="text" name="re_reply_content"
                               class="form-control col-sm-10 reply_content"
                               aria-label="Sizing example input" id="re_reply_input' . $reply['idx'] . '"
                               aria-describedby="inputGroup-sizing-sm" placeholder="댓글을 작성해주세요 :)">
                        <button type="button" class="col-sm-2 btn" style="left: 10px; background-color: #FBAA48; color: white"
                                id="support_1" onclick="not_re_reload_reply(' . $reply['idx'] . ')">댓글 달기
                        </button>
                    </div>
                </form>
            </div>

    </div>
';

?>