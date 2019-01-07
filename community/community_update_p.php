<?php

include "../db.php";

$bno = $_POST['idx'];

$tmpfile = $_FILES['b_file']['tmp_name'];
$o_name = $_FILES['b_file']['name'];

if ($o_name != "") {
    $folder = "../img/community/";
    $path = "$folder/$o_name";
    move_uploaded_file($_FILES['b_file']['tmp_name'], "$folder/$o_name");

    $sql = mq("update community_tb set title = '".$_POST['title']."', content = '".$_POST['content']."', picture = '".$path."' where idx = '".$_POST['idx']."'");
} else {
    $sql = mq("update community_tb set title = '".$_POST['title']."', content = '".$_POST['content']."' where idx = '".$_POST['idx']."'");
}


echo '<script type="text/javascript">alert("수정 되었습니다.");
location.href="/community/community_read.php?idx='.$bno.'";
</script>';

?>


