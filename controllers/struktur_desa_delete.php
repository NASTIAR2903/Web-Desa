<?php

include "../config/db.php";

$id = $_GET['id'];

$sql = "SELECT foto FROM struktur_desa WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if ($row['foto'] && file_exists("../assets/perangkat/perangkat" . $row['foto'])) {
    unlink("../assets/perangkat/perangkat" . $row['foto']);
}


$sql = "DELETE FROM struktur_desa WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    header("Location: ../views/backend_view/struktur_desa_index.php");
    exit;
} else {
    echo "Error: " . $conn->error;
}
