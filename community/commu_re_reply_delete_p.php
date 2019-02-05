<?php

include "../db.php";

$bno = $_POST['idx'];
$go = $_POST['now_idx'];
//$page = $_POST['page'];

$sql = mq("delete from commu_re_reply_tb where idx='$bno'");

?>