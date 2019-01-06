<?php

include "../db.php";

session_start();

date_default_timezone_set("Asia/SEOUL");

$date = date('Y-m-d H:i:s');

$tmpfile = $_FILES['b_file']['tmp_name'];
$o_name = $_FILES['b_file']['name'];
var_dump($_FILES);
if ($o_name != "") {
    $folder = "../img/buskingteam/";
    $path = "$folder/$o_name";
    move_uploaded_file($_FILES['b_file']['tmp_name'], "$folder/$o_name");
} else {
    $path = "../img/busking_defualt.jpg";
}

$sql = mq("insert into buskingteam_tb(name,date,team_profile) values('" . $_POST['team_name'] . "','" . $date . "','" . $path . "')"); ?>

<script type="text/javascript">alert("등록이 완료되었습니다.");
    location.href = 'buskingteam.php';
</script>


