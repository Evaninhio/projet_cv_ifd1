<?php
session_start();
$_SESSION = array();
session_start();
//DESTRUCTION DES VARIABLES DE SESSION
header("Location:../home/home.php");
?>