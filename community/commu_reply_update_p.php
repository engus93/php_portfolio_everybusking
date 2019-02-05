<?php

include "../db.php";

session_start();

$bno = $_POST['idx'];
//$page = $_POST['page'];
$content = $_POST['content'];

$sql = mq("update commu_reply_tb set content = '".$content."' where idx = '$bno'");

//댓글 내용 넘겨주기
echo $content;

?>