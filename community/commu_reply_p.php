<?php

include "../db.php";

session_start();

$bno = $_POST['idx'];

$sql = mq("insert into commu_reply_tb(con_num, name, pw, content) values ('".$bno."', '".$_SESSION['name']."', '".$_SESSION['user_id']."','".$_POST['reply_content']."')");

?>