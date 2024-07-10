<?php 
 
session_start();
$_SESSION = [];
session_unset();
session_destroy();
 
header("Location:../Form_Login/dashboard.php");
exit;
 
?>