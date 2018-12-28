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

if($id==NULL || $password==NULL || $password_re==NULL || $name==NULL || $phone==NULL || $sex==NULL) //
{
    echo "빈 칸을 모두 채워주세요";
    echo "<a href=sign_up.html>back page</a>";
    exit();
}

if($password!=$password_re) //비밀번호와 비밀번호 확인 문자열이 맞지 않을 경우
{
    echo "비밀번호와 비밀번호 확인이 서로 다릅니다.";
    echo "<a href=sign_up.html>back page</a>";
    exit();
}

$check="SELECT *from user_info WHERE userid='$id'";
$result=$mysqli->query($check);
if($result->num_rows==1)
{
    echo "중복된 id입니다.";
    echo "<a href=sign_up.html>back page</a>";
    exit();
}

$password = mad5($password);
$sql = "insert into user_info_tb (user_id, password, name, phone, sex) VALUES('$id','$password','$name','$phone','$sex')";

echo $sql;

if ($mysqli->query($sql)) {
    echo "<a href=sign_in.html>회원가입 성공</a>";
} else {
    echo "<a href=sign_up.html>회원가입 실패</a>";
}

?>