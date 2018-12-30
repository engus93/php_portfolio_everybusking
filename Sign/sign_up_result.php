<?php
$host = 'localhost';
$user = 'root';
$pw = 'Reg016260!!';
$dbName = 'everybusking_db';
$mysqli = mysqli_connect($host, $user, $pw, $dbName);

$id = $_POST['ID'];
$password = $_POST['password'];
$password_re = $_POST['password_re'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$sex = $_POST['sex'];

$password = mad5($password);
$sql = "insert into user_info_tb (user_id, password, name, phone, sex) VALUES('$id','$password','$name','$phone','$sex')";

echo $sql;

if ($mysqli->query($sql)) {
    echo "<a href=sign_in.html>회원가입 성공</a>";
} else {
    echo "<a href=sign_up.phpsign_up.php>회원가입 실패</a>";
}

?>