<?php
include "../config/db.php";

$id = $_GET['id'];
$sql = "DELETE FROM kategori_berita WHERE id=$id";

if ($conn->query($sql)) {
    header("Location: ../views/backend_view/kategori_berita_index.php");
} else {
    echo "Error: " . $conn->error;
}
