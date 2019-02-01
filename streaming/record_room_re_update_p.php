<?php

include "../db.php";

$bno = $_GET['idx'];
$name = $_GET['title'];
$page = $_GET['page'];

$sql = mq("update record_streaming_tb set title = '" . $name . "' where idx = '" . $bno . "'");

echo '<script type="text/javascript">alert("수정 되었습니다.");
location.href="/streaming/record_room_re.php?page=' . $page . '";
</script>';

?>