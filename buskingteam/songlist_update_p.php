<?php

include "../db.php";

$bno = $_POST['idx'];
$path = $_POST['video_path'];

if ($_FILES['d_file']['tmp_name'] != "") {
    $tmpfile = $_FILES['d_file']['tmp_name'];
    $o_name = $_FILES['d_file']['name'];
    $folder = "../mp4/songlist/";
    $path = "$folder/$o_name";
    move_uploaded_file($_FILES['d_file']['tmp_name'], "$folder/$o_name");
} else {

}

echo $path;

$sql = mq("update songlist_tb set title = '".$_POST['title']."', content = '".$_POST['content']."', video_path = '".$path."' where idx = '".$_POST['idx']."'");

echo '<script type="text/javascript">alert("수정 되었습니다.");
location.href="/buskingteam/songlist.php?idx='.$_POST['con_num'].'&team_name='.$_POST['team_name'].'&page='.$_POST['page'].'"; 
</script>';

?>


