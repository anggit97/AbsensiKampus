<?php  
/*
Atur Database disini
*/
$host 	  = "localhost";
$username = "root";
$password = "secret";
$database = "absensi";

$conn	  = new mysqli($host,$username,$password,$database) or die("Gagal Konek database");

?>