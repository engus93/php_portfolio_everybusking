<?php

$conn = new mysqli("localhost", "root", "Reg016260!!", "everybusking_db");

if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

}

function mq($sql){
    global $conn;
    return $conn->query($sql);
}


?>