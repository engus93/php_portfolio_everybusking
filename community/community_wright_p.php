<?php

include "../db.php";

session_start();

$date = date('Y-m-d H:i:s');

echo $date;

$sql = mq("insert into community_tb(name,pw,title,content,date) values('".$_SESSION['name']."','".$_SESSION['user_id']."','".$_POST['title']."','".$_POST['content']."','".$date."')"); ?>
<script type="text/javascript">alert("글쓰기 완료되었습니다.");
location.href='community.php';
</script>

?>

