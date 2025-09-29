<?php
$host = "localhost";
$user = "root";
$port = 3307;
$pass = "";
$db   = "web_desa";

$conn = mysqli_connect($host, $user, $pass, $db, $port);

if(!$conn){
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
