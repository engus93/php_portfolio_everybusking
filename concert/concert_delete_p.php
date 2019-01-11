<?php
include "../db.php";

session_start();

$bno = $_GET['idx']; //버스킹 팀 인덱스
$page = $_GET['page'];

if ($_SESSION['user_id'] == "rhksflwk") {

    $sql = mq("delete from concert_tb where idx='$bno';");

    echo '<script type="text/javascript">alert("삭제 되었습니다.");
             location.href = "/concert/concert.php?page='.$page.'";
           </script>';

} else {

    echo '<script type="text/javascript">alert("관리자 권한이 필요합니다.");
             location.href = "/concert/concert.php?page='.$page.'";
           </script>';
}

?>

