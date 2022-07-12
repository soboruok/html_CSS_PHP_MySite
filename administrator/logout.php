<?php
session_start();
$_SESSION['uusername']="";
$_SESSION['uemail']="";
session_destroy();
header('Location:login.php'); 
?>


