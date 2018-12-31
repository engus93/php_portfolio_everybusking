<?php
include "../db.php";
if ($_POST['ID'] != NULL) {
    $sql = "select * from user_info_tb where user_id = '{$_POST['ID']}'";

    // DB 에 쿼리 날리기
    $result = mysqli_query($conn, $sql);

    // 쿼리 결과를 PHP 에서 사용할 수 있도록 변경
    $row = mysqli_fetch_assoc($result);

    if ($row >= 1) {
        echo "true";
//        echo "<script>parent.find(#user_id).css('background-color', '#F00');</script>";
    } else {
        echo "false";
//        echo "<script>parent.find(#user_id).css('background-color', '#F90');</script>";
    }
}else{
    echo "　";
};
?>