<?php
require_once "../db.php";

$uid = $_POST['ID'];
$name = $_POST['name'];
$phone = $_POST['phone'];

// 쿼리 만들기
$sql = "SELECT * FROM user_info_tb WHERE user_id='$uid'";

// DB 에 쿼리 날리기
$result = mysqli_query($conn, $sql);

// 쿼리 결과를 PHP 에서 사용할 수 있도록 변경
$row = mysqli_fetch_assoc($result);

?>

<script>
    var user_id = "<?= $row['user_id']?>";
    var user_name = "<?= $row['name']?>";
    var user_phone = "<?= $row['phone']?>";
    var new_pass = "<?= base64_decode($row['password'])?>";

    console.log(new_pass);

    var forgot_uid = "<?= $uid?>";
    var forgot_name = "<?= $name?>";
    var forgot_phone = "<?= $phone?>";

    if (user_id != forgot_uid) {
        alert("아이디가 일치하지 않습니다.");
    } else if (user_name != forgot_name) {
        alert("이름이 일치하지 않습니다.");
    } else if (user_phone != forgot_phone) {
        alert("전화번호가 일치하지 않습니다.");
    } else if (user_id == forgot_uid && user_name == forgot_name && user_phone == forgot_phone && user_id.length != 0 && user_name.length != 0 && user_phone.length != 0) {
        alert(user_name + "님의 비밀번호는 " + new_pass + "입니다.");
        parent.location.href = "sign_in.html";
    }

</script>

