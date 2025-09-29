<?php
include "../../config/db.php";

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$nik = $_POST['nik'];
$pekerjaan = $_POST['pekerjaan'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$tanggal_lahir = $_POST['tanggal_lahir'];

$sql = "INSERT INTO users (name, email, password, nik, pekerjaan, jenis_kelamin, tanggal_lahir) 
        VALUES ('$name', '$email', '$password', '$nik', '$pekerjaan', '$jenis_kelamin', '$tanggal_lahir')";

if ($conn->query($sql)) {
    header("Location: ../../views/frontend_view/login.php");
} else {
    echo "Error: " . $conn->error;
}
