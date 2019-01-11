<?php

include "../db.php";

session_start();

date_default_timezone_set("Asia/SEOUL");

//$date = date('Y-m-d');

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
    $path = "../img/no_image.gif";
}

$sql = mq("insert into concert_tb(name,picture,concert_date,birth,genre,profile_text)
values('" . $_POST['team_name'] . "','" . $path . "','" . $date . "','" . $birth . "','" . $genre . "','" . $profile_text . "')");

?>

<script type="text/javascript">alert("등록이 완료되었습니다.");
    location.href = '/concert/concert.php';
</script>


