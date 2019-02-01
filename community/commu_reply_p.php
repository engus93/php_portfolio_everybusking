<?php

include "../db.php";

session_start();

$bno = $_POST['con_num'];
$content = $_POST['reply_content'];

$sql = mq("insert into commu_reply_tb(con_num, name, pw, content) values ('".$bno."', '".$_SESSION['name']."', '".$_SESSION['user_id']."','".$content."')");

//echo json_encode($content);;

?>

