<?php

include "../db.php";

session_start();

$sql = mq("update application_tb set whether = '" . $_POST['whether'] . "' where idx = '" . $_POST['idx'] . "'");

echo '<script>
location.href="/my_page/manager_application.php?page='.$_POST["page"].'"; 
</script>';

?>


