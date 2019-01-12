<?php

include "../db.php";

$bno = $_POST['idx'];
$date = date($_POST['date']);
$birth = $_POST['birth'];
$genre = $_POST['genre'];
$profile_text = $_POST['profile_text'];

if (!empty($_FILES['b_file']['tmp_name'])) {
    $tmpfile = $_FILES['b_file']['tmp_name'];
    $o_name = $_FILES['b_file']['name'];
    $folder = "../img/concert/";
    $path = "$folder/$o_name";

    //폴더 체크 후 생성
    if(!is_dir( $folder)){
        mkdir( $folder );
    }

    move_uploaded_file($_FILES['b_file']['tmp_name'], "$folder/$o_name");

} else {
    $path = $_POST['picture'];
}

$sql = mq("update concert_tb set name = '" . $_POST['team_name'] . "',picture = '" . $path . "',concert_date = '" . $date . "'
,birth = '" . $birth . "',genre = '" . $genre . "',profile_text = '" . $profile_text . "' where idx = '".$bno."'");

if (!empty($_POST['page'])) {
    echo '<script type="text/javascript">alert("수정 되었습니다.");
location.href="/concert/concert.php?page=' . $_POST['page'] . '";
</script>';

} else {
    echo '<script type="text/javascript">alert("수정 되었습니다.");
location.href="/my_page/manager_busking_team.php?page=' . $_POST['manager_page'] . '";
</script>';
}


?>
