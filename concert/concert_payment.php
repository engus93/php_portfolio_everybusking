<?php

include "../db.php";

session_start();

$bno = $_POST['idx'];
$name = $_SESSION['name'];
$user_id = $_SESSION['user_id'];
$e_mail = $_SESSION['e_mail'];
$phone = $_SESSION['phone'];
$product = $_POST['product'];
$price = $_POST['sum'];
$date = date('Y-m-d H:i:s');
$post = "";
$addr = "";

if(!empty($_POST['user_post']) && !empty($_POST['user_addr']) ){

    $post = $_POST['user_post'];
    $addr = $_POST['user_addr']."　/　".$_POST['wRestAddress'];

}else{

    $post = "";
    $addr = "콘서트 당일 수령";

}

$sql = mq("insert into payment_tb(name,id,e_mail,phone,product,price,date,post,addr)
values('" . $name . "','" . $user_id . "','" . $e_mail . "','" . $phone . "','" . $product . "','" . $price . "','" . $date . "','" . $post . "','" . $addr . "')");

?>

<script>
    alert('결제가 완료되었습니다. 감사합니다.');
    document.location.href = '/concert/concert_information.php?idx=<?=$bno?>';
</script>