<?php

include "../db.php";

$bno = $_POST['idx'];

$tmpfile = $_FILES['b_file']['tmp_name'];
$o_name = $_FILES['b_file']['name'];

if ($o_name != "") {
    $folder = "../img/buskingteam/";
    $path = "$folder/$o_name";
    move_uploaded_file($_FILES['b_file']['tmp_name'], "$folder/$o_name");
} else {
    $path = $_POST['team_profile'];
}

$sql = mq("update buskingteam_tb set name = '".$_POST['team_name']."', team_profile = '".$path."' where idx = '".$_POST['idx']."'");

echo '<script type="text/javascript">alert("수정 되었습니다.");
location.href="/buskingteam/buskingteam.php?page='.$_POST['page'].'";
</script>';

?>


