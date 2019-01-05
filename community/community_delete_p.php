<?php
include "../db.php";

session_start();

$bno = $_GET['idx'];

// 쿼리 만들기
$sql = "SELECT * FROM community_tb WHERE idx='$bno'";

// DB 에 쿼리 날리기
$result = mysqli_query($conn, $sql);

// 쿼리 결과를 PHP 에서 사용할 수 있도록 변경
$row = mysqli_fetch_assoc($result);

if ($row['pw'] == $_SESSION['user_id'] || $_SESSION['user_id'] == "rhksflwk") {

    $sql = mq("delete from community_tb where idx='$bno';");
    $sql = mq("delete from commu_reply_tb where con_num='$bno';");

    echo '<script type="text/javascript">alert("삭제 되었습니다.");
           location.href = "/community/community.php";
           </script>';

} else {

    echo '<script type="text/javascript">alert("자신의 게시물만 삭제가 가능합니다.");
           location.href = "/community/community_read.php?idx=' . $bno . '";
           </script>';
}

?>

