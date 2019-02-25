<?php require "Config/session.php";?>
<?php
$_SESSION['id'] = null;
$expireTime = time()-86400;
setcookie("EmailCo", null, $expireTime);
setcookie("UsernameCo", null, $expireTime);
session_destroy();
header('Location: index.php');
?>


