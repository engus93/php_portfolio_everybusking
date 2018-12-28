<?php
include "../db.php";
$uid = $_GET["userid"];
$sql = search("SELECT * FROM user_info_tb WHERE user_id='$uid'");
$member = $sql->fetch_array();
if ($member == 0){
    ?>
    <div style='font-family:"malgun gothic"; text-align: center; margin-top: 20px'><?php echo $uid; ?>는 사용가능한 아이디입니다.</div>
    <?php
}else{
?>
<div style='font-family:"malgun gothic"; color:red; text-align: center; margin-top: 20px'><?php echo $uid; ?>중복된아이디입니다.
    <div>
        <?php
        }
        ?>
        <button value="닫기" onclick="window.close()" style="position: absolute; left: 45%; bottom: 10px">닫기</button>
        <script>
        </script>