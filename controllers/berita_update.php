<?php
include "../config/db.php";

$id = $_POST['id'];
$judul = $_POST['judul'];
$isi = $_POST['isi'];
$kategori_id = $_POST['kategori_id'];
$tanggal_publikasi = $_POST['tanggal_publikasi'];
$old_gambar = $_POST['old_gambar'] ?? null;


$gambar = $old_gambar;


if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
   
    if ($old_gambar && file_exists("../assets/berita/" . $old_gambar)) {
        unlink("../assets/berita/" . $old_gambar);
    }

    
    $gambar = time() . '_' . basename($_FILES['gambar']['name']);
    move_uploaded_file($_FILES['gambar']['tmp_name'], "../assets/berita/" . $gambar);
}


$sql = "UPDATE berita 
        SET judul='$judul', 
            isi='$isi', 
            gambar='$gambar', 
            kategori_id=" . ($kategori_id ? "'$kategori_id'" : "NULL") . ", 
            tanggal_publikasi='$tanggal_publikasi'
        WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: ../views/backend_view/berita_index.php");
    exit;
} else {
    echo "Error: " . $conn->error;
}
