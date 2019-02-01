<?php

include "../db.php";

session_start();

$bno = $_POST['idx'];
$go = $_POST['now_idx'];
$page = $_POST['page'];

$sql = mq("delete from commu_reply_tb where idx='$bno'");

//echo '<script type="text/javascript">alert("삭제 되었습니다.");
//location.href="/community/community_read.php?idx='.$go.'&page='.$page.'";
//</script>';

?>