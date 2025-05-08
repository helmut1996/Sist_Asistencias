<?php
session_start();
session_unset();    
session_destroy();
header("location:/sistema-asistencia/vista/login/login.php");
exit();
?>