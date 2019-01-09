<?php

include "db.php";

session_start();

$select_name = $_POST['select_name'];
$select_content = $_POST['select_content'];
$date = date('Y-m-d H:i:s');

$sql = mq("insert into application_tb (select_name,select_content,date,write_user) values('" . $select_name . "','" . $select_content . "','" . $date . "','" . $_SESSION['user_id']. "')");
?>
<script type="text/javascript">alert("신청이 완료되었습니다.");
    location.href = '/main.php';
</script>


