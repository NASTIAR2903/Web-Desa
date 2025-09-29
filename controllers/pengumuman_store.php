<?php

include "../config/db.php";

$judul = $_POST['judul'];
$isi = $_POST['isi'];
$tanggal_pelaksanaan = $_POST['tanggal_pelaksanaan'];

$sql = "INSERT INTO pengumuman (judul, isi, tanggal_pelaksanaan) 
        VALUES ('$judul', '$isi', '$tanggal_pelaksanaan')";

if ($conn->query($sql) === TRUE) {
    header("Location: ../views/backend_view/pengumuman_index.php");
    exit;
} else {
    echo "Error: " . $conn->error;
}
