<?php

include "../db.php";

session_start();

$title = $_POST['title'];

$user_id = $_SESSION['user_id'];

date_default_timezone_set("Asia/SEOUL");

$date = date('Y-m-d H:i:s');

//if (!empty($_FILES['c_file']['tmp_name'])) {
//    $tmpfile = $_FILES['c_file']['tmp_name'];
//    $o_name = $date.$_FILES['c_file']['name'];
//    $folder = "../img/streaming/";
//    $path = "$folder/$o_name";
//
//    //폴더 체크 후 생성
//    if (!is_dir($folder)) {
//        mkdir($folder);
//    }
//
//    move_uploaded_file($_FILES['c_file']['tmp_name'], "$folder/$o_name");
//
//} else {
//
//    $path = '/img/streaming_default.gif';
//
//}

$path = $_SESSION['profile'];

$streamer_name = $_SESSION['user_id'];

$sql = mq("insert into streaming_tb(streamer,streamer_id,date,picture,title) values('" . $title . "','" . $user_id . "','" . $date . "','" . $path . "','" . $streamer_name . "')");

$sql_re = mq("select * from streaming_tb where date = '" . $date . "'");

$board = $sql_re->fetch_array();

echo $board[0];

?>