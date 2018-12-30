<?php
//session_start();

$conn = new mysqli("localhost","root","Reg016260!!","everybusking_db");
//$db->set_charset("utf8");
//
//function search($sql){
//    global $db;
//    return $db->query($sql);
//}

if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

}

?>