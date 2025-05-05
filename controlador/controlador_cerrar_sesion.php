<?php
session_start();
session_unset();    
session_destroy();
header("location:../vista/login/login.php");
exit();
?>