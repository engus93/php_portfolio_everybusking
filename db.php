<?php
session_start();

$db = new mysqli("localhost","root","Reg016260!!","everybusking_db");
$db->set_charset("utf8");

function search($sql){
    global $db;
    return $db->query($sql);
}

?>