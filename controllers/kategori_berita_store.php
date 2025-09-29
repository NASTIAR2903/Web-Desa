<?php
include "../config/db.php";

$nama = $_POST['nama_kategori'];

$sql = "INSERT INTO kategori_berita (nama_kategori) VALUES ('$nama')";
if ($conn->query($sql)) {
    header("Location: ../views/backend_view/kategori_berita_index.php");
} else {
    echo "Error: " . $conn->error;
}
