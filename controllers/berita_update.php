<?php

include "../config/db.php";

$id = $_POST['id'];
$judul = $_POST['judul'];
$isi = $_POST['isi'];

$sql = "SELECT gambar FROM berita WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$gambar = $row['gambar'];

if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
    if ($gambar && file_exists("../assets/berita/".$gambar)) {
        unlink("../assets/berita/".$gambar);
    }
    $gambar = time().'_'.basename($_FILES['gambar']['name']);
    move_uploaded_file($_FILES['gambar']['tmp_name'], "../assets/berita/".$gambar);
}

$sql = "UPDATE berita SET judul='$judul', isi='$isi', gambar='$gambar' WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    header("Location: ../views/backend_view/berita_index.php");
    exit;
} else {
    echo "Error: " . $conn->error;
}
