<?php
include "../config/db.php";

$id          = $_POST['id'];
$judul       = $_POST['judul'];
$deskripsi   = $_POST['deskripsi'];
$gambar_lama = $_POST['gambar_lama'];

$targetDir = "../assets/sliders/";


if (!empty($_FILES['gambar']['name'])) {
    $gambar = time() . "_" . $_FILES['gambar']['name'];
    $targetFile = $targetDir . $gambar;


    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetFile)) {
        
        if (!empty($gambar_lama) && file_exists($targetDir . $gambar_lama)) {
            unlink($targetDir . $gambar_lama);
        }
    }
} else {
    $gambar = $gambar_lama;
}

$sql = "UPDATE slider_hero SET judul='$judul', deskripsi='$deskripsi', gambar='$gambar' WHERE id=$id";

if ($conn->query($sql)) {
    header("Location: ../views/backend_view/slider_index.php");
    exit;
} else {
    echo "Error: " . $conn->error;
}
