<?php

include "../config/db.php";

$id = $_GET['id'];

$sql = "SELECT gambar FROM berita WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if ($row['gambar'] && file_exists("../assets/berita/".$row['gambar'])) {
    unlink("../assets/berita/".$row['gambar']);
}

$sql = "DELETE FROM berita WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    header("Location: ../views/backend_view/berita_index.php");
    exit;
} else {
    echo "Error: " . $conn->error;
}
