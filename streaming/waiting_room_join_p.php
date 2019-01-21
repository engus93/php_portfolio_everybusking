<?php

include "../db.php";

session_start();

$room_idx = $_POST['room_idx'];

$sql = mq("select * from streaming_tb where idx = '".$room_idx."'");

$board = $sql->fetch_array();

echo $board[4];

?>