<?php

session_start();
session_destroy();
header("location:/sis_asistencia/vista/login/login.php");

?>