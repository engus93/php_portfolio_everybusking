<?php
include "../db.php";

session_start();

$bno = $_GET['idx']; //버스킹 팀 인덱스
$page = $_GET['page'];
$team_name = $_GET['team_name'];
$con_num = $_GET['con_num']; //송리스트 인덱스 분류

if ($_SESSION['user_id'] == "rhksflwk") {

    $sql = mq("delete from songlist_tb where idx='$con_num';");

    echo '<script type="text/javascript">alert("삭제 되었습니다.");
             location.href = "/buskingteam/songlist.php?idx='.$bno.'&team_name='.$team_name.'";
           </script>';

} else {

    echo '<script type="text/javascript">alert("관리자 권한이 필요합니다.");
             location.href = "/buskingteam/songlist.php";
           </script>';
}

?>

