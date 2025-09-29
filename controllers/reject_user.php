<?php
include "../config/db.php";

$id = $_GET['id'];


$sql = "UPDATE users SET status='rejected' WHERE id=$id";
if ($conn->query($sql)) {
    header("Location: ../views/backend_view/user_index.php");
} else {
    echo "Error: " . $conn->error;
}
