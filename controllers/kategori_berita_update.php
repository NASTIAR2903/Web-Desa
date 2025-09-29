<?php
include "../config/db.php";

$id = $_POST['id'];
$nama = $_POST['nama_kategori'];

$sql = "UPDATE kategori_berita SET nama_kategori='$nama' WHERE id=$id";
if ($conn->query($sql)) {
    header("Location: ../views/backend_view/kategori_berita_index.php");
} else {
    echo "Error: " . $conn->error;
}
