<?php

include "../db.php";

session_start();

$bno = $_GET['idx'];
$go = $_GET['now_idx'];

$sql = mq("delete from commu_reply_tb where idx='$bno'");

echo '<script type="text/javascript">alert("삭제 되었습니다.");
location.href="/community/community_read.php?idx='.$go.'";
</script>';

?>