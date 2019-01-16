<?php

include "../db.php";

session_start();

$bno = $_GET['idx'];
$go = $_GET['now_idx'];
$page = $_POST['re_page'];

$sql = mq("insert into commu_re_reply_tb(con_num, name, pw, content) values ('" . $bno . "', '" . $_SESSION['name'] . "', '" . $_SESSION['user_id'] . "','" . $_POST['re_reply_content'] . "')");

?>

<script>
    location.href ='/community/community_read.php?idx=<?=$go?>&page=<?=$page?>';
</script>
