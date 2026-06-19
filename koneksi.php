<?php
date_default_timezone_set('Asia/Jakarta');
$host = "localhost";
$user = "root"; 
$pass = ""; 
$db   = "db_temuin"; 


$conn = mysqli_connect($host, $user, $pass, $db);


if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>