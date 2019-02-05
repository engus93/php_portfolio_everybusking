<?php

include "../db.php";

session_start();

$bno = $_POST['idx'];
$go = $_POST['now_idx'];
//$page = $_POST['page'];

$sql = mq("delete from commu_reply_tb where idx='$bno'");
$sql = mq("delete from commu_re_reply_tb where con_num = '$bno'");

?>