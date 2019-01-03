<?php
include "../db.php";

$bno = $_GET['idx'];

$sql = mq("delete from community_tb where idx='$bno';");

?>

<script type="text/javascript">alert("삭제 되었습니다.");
    location.href='/community/community.php';
</script>
