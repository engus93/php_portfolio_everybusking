<?php

include "../db.php";

session_start();

date_default_timezone_set("Asia/SEOUL");

$date = date('Y-m-d H:i:s');

$tmpfile = $_FILES['b_file']['tmp_name'];
$o_name = $_FILES['b_file']['name'];
$filename = iconv("UTF-8", "EUC-KR", $_FILES['b_file']['name']);

if ($filename != null) {
    $folder = "../img/community/" . $filename;
    move_uploaded_file($tmpfile, $folder);
} else {
    $folder = "../img/busking_defualt.jpg";
}

$sql = mq("insert into community_tb(name,pw,title,content,date,picture) values('" . $_SESSION['name'] . "','" . $_SESSION['user_id'] . "','" . $_POST['title'] . "','" . $_POST['content'] . "','" . $date . "','" . $folder . "')"); ?>

<script type="text/javascript">alert("글쓰기 완료되었습니다.");
    location.href = 'community.php';
</script>


