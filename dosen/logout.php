<?php  
session_start();
unset($_SESSION['dosen']);
header("location:../index.php");
?>