<?php

include "../db.php";

$bno = $_POST['idx'];
$path = $_POST['video_path'];
$team_name = $_POST['team_name'];

if ($_FILES['d_file']['tmp_name'] != "") {
    $tmpfile = $_FILES['d_file']['tmp_name'];
    $o_name = $_FILES['d_file']['name'];
    $folder = "../mp4/songlist/".$team_name;
    $path = "$folder/$o_name";

    //폴더 체크 후 생성
    if(!is_dir( $folder)){
        mkdir( $folder );
    }

    move_uploaded_file($_FILES['d_file']['tmp_name'], "$folder/$o_name");
} else {

}

$sql = mq("update songlist_tb set title = '".$_POST['title']."', content = '".$_POST['content']."', video_path = '".$path."' where idx = '".$_POST['idx']."'");

echo '<script type="text/javascript">alert("수정 되었습니다.");
location.href="/buskingteam/songlist.php?idx='.$_POST['con_num'].'&team_name='.$_POST['team_name'].'&page='.$_POST['page'].'"; 
</script>';

?>


