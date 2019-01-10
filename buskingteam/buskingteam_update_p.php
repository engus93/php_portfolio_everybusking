<?php

include "../db.php";

$bno = $_POST['idx'];

if (!empty($_FILES['b_file']['tmp_name'])) {
    $tmpfile = $_FILES['b_file']['tmp_name'];
    $o_name = $_FILES['b_file']['name'];
    $folder = "../img/buskingteam/";
    $path = "$folder/$o_name";
    move_uploaded_file($_FILES['b_file']['tmp_name'], "$folder/$o_name");
} else {
    $path = $_POST['team_profile'];
}

$sql = mq("update buskingteam_tb set name = '" . $_POST['team_name'] . "', team_profile = '" . $path . "' where idx = '" . $_POST['idx'] . "'");


if (!empty($_POST['page'])) {
    echo '<script type="text/javascript">alert("수정 되었습니다.");
location.href="/buskingteam/buskingteam.php?page=' . $_POST['page'] . '";
</script>';

} else {
    echo '<script type="text/javascript">alert("수정 되었습니다.");
location.href="/my_page/manager_busking_team.php?page=' . $_POST['manager_page'] . '";
</script>';
}


?>


