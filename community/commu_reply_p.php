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

echo '<div class="cardbox-comments_re reply_view">
                                    <span class="comment-avatar float-left">
                                        <img class="circle_image" style="margin-top: 5px; width: 30px; height: 30px"
                                             src=' . $_SESSION['profile'] . '></span>
    <div class="input-group  my_font_main" style="width: 90%; margin-top: 10px; left: 15px">
        <span>' . $reply['name'] . '　</span>
        <span id="real_reply_' . $reply['idx'] . '">' . nl2br("$reply[content]") . '</span>
        <span style="font-size: 10px; color: #4e555b; position: absolute; right: 0px; margin-top: 5px;">' . $reply['date'] . '</span>
    </div>
    
</div>
';

?>