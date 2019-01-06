<?php
require_once "../db.php";

if(isset($_POST["rememberme"])){
    $duration = 7 * 24 * 60 * 60;
    ini_set('session.gc_maxlifetime', $duration);
    session_set_cookie_params($duration);
}

session_start();

$uid = $_POST['ID'];
$password = base64_encode($_POST['password']);

// 쿼리 만들기
$sql = "SELECT * FROM user_info_tb WHERE user_id='$uid'";

// DB 에 쿼리 날리기
$result = mysqli_query($conn, $sql);

// 쿼리 결과를 PHP 에서 사용할 수 있도록 변경
$row = mysqli_fetch_assoc($result);

?>

<script>

    var user_id = "<?= $row['user_id']?>";
    var user_pass = "<?= $row['password']?>";
    var user_name = "<?= $row['name']?>";

    var login_pass = "<?= $password?>";

    if (user_id.length == 0) {
        alert("아이디가 일치하지 않습니다.");
        history.back();
    } else if (login_pass == user_pass) {

        "<?php $_SESSION['user_id'] = $row['user_id']?>"
        "<?php $_SESSION['password'] = $row['password']?>"
        "<?php $_SESSION['name'] = $row['name']?>"
        "<?php $_SESSION['phone'] = $row['phone']?>"
        "<?php $_SESSION['sex'] = $row['sex']?>"
        "<?php $_SESSION['profile'] = $row['profile']?>"

        alert(user_name + "님 환영합니다.");
        location.href = '../main.php';
    } else {
        alert("비밀번호가 일치하지 않습니다.");
        history.back();
    }

</script>

