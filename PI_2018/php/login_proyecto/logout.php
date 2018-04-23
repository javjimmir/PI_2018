<?php
session_start();
session_destroy();
header('location: ./prueba.php');
?>