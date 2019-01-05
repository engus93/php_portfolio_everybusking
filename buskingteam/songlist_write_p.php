<?php

include "../db.php";

session_start();

date_default_timezone_set("Asia/SEOUL");

$idx = $_POST['con_num'];
$team_name = $_POST['team_name'];

$tmpfile = $_FILES['b_file']['tmp_name'];
$o_name = $_FILES['b_file']['name'];

if ($o_name != "") {
    $folder = "../mp4/songlist/";
    $path = "$folder/$o_name";
    move_uploaded_file($_FILES['b_file']['tmp_name'], "$folder/$o_name");
} else {
    echo '<script>alert("죄송합니다. 동영상이 없으면 등록이 불가합니다."); history.back();</script>';
}

//echo $_POST['con_num'];
//echo $_POST['title'];
//echo $_POST['content'];
//echo $path;

$sql = mq("insert into songlist_tb(con_num,title,content,video_path) values('" . $_POST['con_num'] . "','" . $_POST['title'] . "','" . $_POST['content'] . "','" . $path . "')"); ?>

<script type="text/javascript">alert("등록이 완료되었습니다.");
    location.href = "/buskingteam/songlist.php?idx=<?=$idx?>&team_name=<?=$team_name?>";
</script>


desc