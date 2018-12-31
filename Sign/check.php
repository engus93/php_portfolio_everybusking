<?php
require_once "../db.php";

$uid = $_GET["userid"];

// 쿼리 만들기
$sql = "SELECT * FROM user_info_tb WHERE user_id='$uid'";

// DB 에 쿼리 날리기
$result = mysqli_query($conn, $sql);

// 쿼리 결과를 PHP 에서 사용할 수 있도록 변경
$row = mysqli_fetch_assoc($result);

//echo "<pre>";
//print_r($row);
//echo "</pre>";

?>

<script>
    var row = "<?= $row['user_id']?>";

    if (row.length != 0) {
        alert("이미 사용중인 아이디입니다.");

    } else {
        alert("사용 가능합니다.");

    }

</script>