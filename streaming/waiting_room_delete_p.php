<?php

include "../db.php";

session_start();

$room = $_POST['now_room_idx'];

echo $room;

//$sql = mq("delete from streaming_tb where idx='$con_num';");

?>