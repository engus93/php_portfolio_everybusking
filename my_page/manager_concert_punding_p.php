<?php

include "../db.php";

$bno = $_POST['idx'];

$sql = mq("update payment_tb set etc = '" . '배송 중' . "' where idx = '" . $bno . "'");

echo '<script type="text/javascript">alert("수정 되었습니다.");
location.href="/my_page/manager_concert_punding.php?page=' . $_POST['page'] . '";
</script>';

?>
