<?php

include "../db.php";

session_start();

$room = $_POST['now_room_idx'];

$sql = mq("update streaming_tb set ing ='false' where idx='$room';");

?>

<script>
    alert("방송이 종료되었습니다.");
    document.location.href="http://192.168.253.138/streaming/waiting_room.php"
</script>
