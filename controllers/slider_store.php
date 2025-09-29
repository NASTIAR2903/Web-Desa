<?php
include "../config/db.php";

$judul = $_POST['judul'];
$deskripsi = $_POST['deskripsi'];

$gambar = time() . "_" . $_FILES['gambar']['name'];
move_uploaded_file($_FILES['gambar']['tmp_name'], "../assets/sliders/" . $gambar);

$sql = "INSERT INTO slider_hero (judul, deskripsi, gambar) VALUES ('$judul', '$deskripsi', '$gambar')";
if ($conn->query($sql)) {
    header("Location: ../views/backend_view/slider_index.php");
} else {
    echo "Error: " . $conn->error;
}
