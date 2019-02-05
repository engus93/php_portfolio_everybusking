<?php

include "../db.php";

session_start();

$bno = $_POST['idx'];
//$page = $_POST['page'];
$re_content = $_POST['content'];

$sql = mq("update commu_re_reply_tb set content = '".$re_content."' where idx = '$bno'");

echo $re_content;

?>