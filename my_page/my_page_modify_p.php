<?php

include "../db.php";

session_start();

$password = $_POST['password'];
$password_re = base64_encode($password);
$phone = $_POST['phone'];
$mail = $_POST['e_mail'];

$sql = mq("update user_info_tb set password = '" . $password_re . "', phone = '" . $phone . "', e_mail = '" . $mail . "' where user_id = '" . $_SESSION['user_id'] . "'");

$_SESSION['password'] = $password_re;
$_SESSION['phone'] = $phone;
$_SESSION['e_mail'] = $mail;

echo '<script type="text/javascript">alert("변경 되었습니다.");
location.href="/my_page/my_page_modify.php"; 
</script>';

?>


