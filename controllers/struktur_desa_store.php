<?php
include "../config/db.php";

$nik            = $_POST['nik'];
$nama           = $_POST['nama'];
$tempat_lahir   = $_POST['tempat_lahir'];
$tanggal_lahir  = $_POST['tanggal_lahir'];
$jenis_kelamin  = $_POST['jenis_kelamin'];
$alamat         = $_POST['alamat'];
$no_hp          = $_POST['no_hp'];
$email          = $_POST['email'];
$jabatan        = $_POST['jabatan'];
$pendidikan     = $_POST['pendidikan'];
$mulai_jabatan  = $_POST['mulai_jabatan'];
$akhir_jabatan  = $_POST['akhir_jabatan'];
$status         = $_POST['status'];
$keterangan     = $_POST['keterangan'];
$foto           = null;


if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $foto = time() . '_' . basename($_FILES['foto']['name']);
    move_uploaded_file($_FILES['foto']['tmp_name'], "../assets/perangkat/perangkat" . $foto);
}

$sql = "INSERT INTO struktur_desa 
        (nik, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, alamat, no_hp, email, jabatan, pendidikan, mulai_jabatan, akhir_jabatan, status, foto, keterangan) 
        VALUES 
        ('$nik', '$nama', '$tempat_lahir', '$tanggal_lahir', '$jenis_kelamin', '$alamat', '$no_hp', '$email', '$jabatan', '$pendidikan', '$mulai_jabatan', '$akhir_jabatan', '$status', '$foto', '$keterangan')";

if ($conn->query($sql) === TRUE) {
    header("Location: ../views/backend_view/struktur_desa_index.php");
    exit;
} else {
    echo "Error: " . $conn->error;
}
