<?php

include "../db.php";

session_start();

$bno = $_GET['idx'];
$go = $_GET['now_idx'];
$page = $_POST['page'];

$sql = mq("update commu_re_reply_tb set content = '".$_POST['content']."' where idx = '$bno'");

echo '<script type="text/javascript">alert("수정 되었습니다.");
location.href="/community/community_read.php?idx='.$go.'&page='.$page.'";
</script>';

?>