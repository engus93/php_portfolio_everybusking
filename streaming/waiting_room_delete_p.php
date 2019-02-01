<?php
include "../db.php";

session_start();

$bno = $_GET['idx'];
$page = $_GET['page'];

$sql = mq("delete from record_streaming_tb where idx='$bno';");

echo '<script type="text/javascript">alert("삭제 되었습니다.");
           location.href = "/streaming/record_room_re.php?page=' . $page . '";
           </script>';

?>

