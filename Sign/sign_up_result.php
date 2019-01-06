<?php
$host = 'localhost';
$user = 'root';
$pw = 'Reg016260!!';
$dbName = 'everybusking_db';
$mysqli = mysqli_connect($host, $user, $pw, $dbName);

$id = $_POST['ID'];
$password = $_POST['password'];
$password_re = base64_encode($password);
$name = $_POST['name'];
$phone = $_POST['phone'];
$sex = $_POST['sex'];

$sql = "insert into user_info_tb (user_id, password, name, phone, sex) VALUES('$id','$password_re','$name','$phone','$sex')";

if ($mysqli->query($sql)) {
    echo "<script>alert('가입을 축하드립니다!');parent.location.href=sign_in.php/script>";

} else {
    echo "<script>alert('가입에 실패했습니다.');history.back()</script>";
}

?>