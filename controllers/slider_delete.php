<?php
include "../config/db.php";

$id = $_GET['id'];
$targetDir = "../assets/sliders/";


$getImg = $conn->query("SELECT gambar FROM slider_hero WHERE id=$id");
if ($getImg && $getImg->num_rows > 0) {
    $row = $getImg->fetch_assoc();
    $gambar = $row['gambar'];

    
    if (!empty($gambar) && file_exists($targetDir . $gambar)) {
        unlink($targetDir . $gambar);
    }
}


$sql = "DELETE FROM slider_hero WHERE id=$id";
if ($conn->query($sql)) {
    header("Location: ../views/backend_view/slider_index.php");
    exit;
} else {
    echo "Error: " . $conn->error;
}
