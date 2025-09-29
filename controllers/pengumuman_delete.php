<?php

include "../config/db.php";

$id = $_GET['id'];
$sql = "DELETE FROM pengumuman WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: ../views/backend_view/pengumuman_index.php");
    exit;
} else {
    echo "Error: " . $conn->error;
}
