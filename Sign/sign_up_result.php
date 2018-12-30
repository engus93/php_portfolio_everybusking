<?php
$host = 'localhost';
$user = 'root';
$pw = 'Reg016260!!';
$dbName = 'everybusking_db';
$mysqli = mysqli_connect($host, $user, $pw, $dbName);

$id = $_POST['ID'];
$password = md5($_POST['password']);
$password_re = $_POST['password_re'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$sex = $_POST['sex'];

$password = $password;
$sql = "insert into user_info_tb (user_id, password, name, phone, sex) VALUES('$id','$password','$name','$phone','$sex')";

if ($mysqli->query($sql)) {
    echo "<script>alert('가입을 축하드립니다!');location.href='sign_in.html'</script>";

} else {
    echo "<script>alert('가입에 실패했습니다.');history.back()</script>";
}

?>