<?php

include "../db.php";

session_start();

date_default_timezone_set("Asia/SEOUL");

$date = date('Y-m-d H:i:s');

$tmpfile = $_FILES['b_file']['tmp_name'];
$o_name = $_FILES['b_file']['name'];

if ($o_name != "") {
    $folder = "../img/community/";
    $path = "$folder/$o_name";
    move_uploaded_file($_FILES['b_file']['tmp_name'], "$folder/$o_name");
} else {
    $path = "../img/no_image.gif";
}

for ($i = 0; $i<=20; $i++) {
$sql = mq("insert into community_tb(name,pw,title,content,date,picture) values('" . $_SESSION['name'] . "','" . $_SESSION['user_id'] . "','" . $_POST['title'] . "','" . $_POST['content'] . "','" . $date . "','" . $path . "')");

}
?>

<script type="text/javascript">alert("글쓰기 완료되었습니다.");
    location.href = 'community.php';
</script>


