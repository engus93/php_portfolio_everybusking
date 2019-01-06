<?php

include "../db.php";

session_start();

date_default_timezone_set("Asia/SEOUL");

$idx = $_POST['con_num'];
$team_name = $_POST['team_name'];

if (isset($_FILES['c_file']['tmp_name'])) {
    $tmpfile = $_FILES['c_file']['tmp_name'];
    $o_name = $_FILES['c_file']['name'];
    $folder = "../mp4/songlist/".$team_name;
    $path = "$folder/$o_name";

    //폴더 체크 후 생성
    if(!is_dir( $folder)){
        mkdir( $folder );
    }

    move_uploaded_file($_FILES['c_file']['tmp_name'], "$folder/$o_name");
    $sql = mq("insert into songlist_tb(con_num,title,content,video_path) values('" . $_POST['con_num'] . "','" . $_POST['title'] . "','" . $_POST['content'] . "','" . $path . "')");
    echo '<script>alert("등록이 완료되었습니다.");</script>';
} else {
    echo '<script>alert("죄송합니다. 동영상이 없으면 등록이 불가합니다."); </script>';
}
?>

<script>location.href = "/buskingteam/songlist.php?idx=<?=$idx?>&team_name=<?=$team_name?>";</script>