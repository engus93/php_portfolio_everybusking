<?php

include "../db.php";

$bno = $_POST['idx'];

$sql = mq("update community_tb set title = '".$_POST['title']."', content = '".$_POST['content']."' where idx = '".$_POST['idx']."'");


?>

<script type="text/javascript">alert("수정 되었습니다.");
location.href='/community/community.php';
</script>
