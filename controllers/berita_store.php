<?php

include "../config/db.php";

$judul = $_POST['judul'];
$isi = $_POST['isi'];
$gambar = null;

if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
    $gambar = time().'_'.basename($_FILES['gambar']['name']);
    move_uploaded_file($_FILES['gambar']['tmp_name'], "../assets/berita/".$gambar);
}

$sql = "INSERT INTO berita (judul, isi, gambar) VALUES ('$judul', '$isi', '$gambar')";
if ($conn->query($sql) === TRUE) {
    header("Location: ../views/backend_view/berita_index.php");
    exit;
} else {
    echo "Error: " . $conn->error;
}
