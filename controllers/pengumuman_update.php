<?php

include "../config/db.php";

$id = $_POST['id'];
$judul = $_POST['judul'];
$isi = $_POST['isi'];
$tanggal_pelaksanaan = $_POST['tanggal_pelaksanaan'];

$sql = "UPDATE pengumuman 
        SET judul='$judul', isi='$isi', tanggal_pelaksanaan='$tanggal_pelaksanaan' 
        WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: ../views/backend_view/pengumuman_index.php");
    exit;
} else {
    echo "Error: " . $conn->error;
}
