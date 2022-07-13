<?php
setcookie("id",null,-1,'/');
session_start();
session_destroy();

header('Location:./login.php');
?>