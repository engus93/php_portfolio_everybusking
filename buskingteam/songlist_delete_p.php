<?php
include "../db.php";

session_start();

$bno = $_GET['idx'];
$page = $_GET['page'];
$team_name = $_GET['team_name'];

// 쿼리 만들기
$sql = "SELECT * FROM songlist_tb WHERE idx='$bno'";

// DB 에 쿼리 날리기
$result = mysqli_query($conn, $sql);

// 쿼리 결과를 PHP 에서 사용할 수 있도록 변경
$row = mysqli_fetch_assoc($result);

if ($_SESSION['user_id'] == "rhksflwk") {

    $sql = mq("delete from songlist_tb where con_num='$bno';");

    echo '<script type="text/javascript">alert("삭제 되었습니다.");
             location.href = "/buskingteam/songlist.php?idx='.$bro.'&team_name='.$team_name.'";
           </script>';

} else {

    echo '<script type="text/javascript">alert("관리자 권한이 필요합니다.");
             location.href = "/buskingteam/songlist.php";
           </script>';
}

?>

