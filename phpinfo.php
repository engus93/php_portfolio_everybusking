<?php

//$connect = mysqli_connect('localhost', 'root', 'Reg016260!!', 'test');
//if(mysqli_connect_error()) {
//    echo "데이터베이스 연결에 실패하였습니다.";
//    mysqli_connect_error();
//}
//$result = mysqli_query($connect, "SELECT * FROM test");
//while($data = mysqli_fetch_array($result))
//{
//    echo $data['userid'];
//}
//mysqli_close($connect);

$host = 'localhost';
$user = 'root';
$pw = 'Reg016260!!';
$dbName = 'everybusking_db';
$mysqli = new mysqli($host, $user, $pw, $dbName);

if($mysqli){
    echo $dbName."에 MySQL 접속 성공";
}else{
    echo "MySQL 접속 실패";
}

phpinfo();
?>