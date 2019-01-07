<?php

include "../db.php";

session_start();

$phone = $_POST['phone'];
$mail = $_POST['e_mail'];

if (isset($_FILES['d_file']['tmp_name'])) {
    $tmpfile = $_FILES['d_file']['tmp_name'];
    $o_name = $_FILES['d_file']['name'];
    $folder = "../img/user_info/";
    $path = "$folder/$o_name";
    move_uploaded_file($_FILES['d_file']['tmp_name'], "$folder/$o_name");
} else {
    $path = $_POST['profile'];
}

if($_POST['password'] != null){
    $password = $_POST['password'];
    $password_re = base64_encode($password);
}else{
    $password_re = $_POST['origine_pass'];
}

$_SESSION['password'] = $password_re;
$_SESSION['phone'] = $phone;
$_SESSION['e_mail'] = $mail;
$_SESSION['profile'] = $path;

$sql = mq("update user_info_tb set password = '" . $password_re . "', phone = '" . $phone . "', e_mail = '" . $mail . "', profile = '" . $path . "' where user_id = '" . $_SESSION['user_id'] . "'");

echo '<script type="text/javascript">alert("변경 되었습니다.");
location.href="/my_page/my_page_modify.php"; 
</script>';

?>


