<?php
include "../config/db.php";

$id             = $_POST['id'];
$nik            = $_POST['nik'];
$nama           = $_POST['nama'];
$tempat_lahir   = $_POST['tempat_lahir'];
$tanggal_lahir  = $_POST['tanggal_lahir'];
$jenis_kelamin  = $_POST['jenis_kelamin'];
$alamat         = $_POST['alamat'];
$no_hp          = $_POST['no_hp'];
$email          = $_POST['email'];
$jabatan        = $_POST['jabatan'];
$pendidikan     = $_POST['pendidikan'];
$mulai_jabatan  = $_POST['mulai_jabatan'];
$akhir_jabatan  = $_POST['akhir_jabatan'];
$status         = $_POST['status'];
$keterangan     = $_POST['keterangan'];


$foto = $_POST['old_foto'] ?? null;


if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    if ($foto && file_exists("../assets/perangkat/perangkat" . $foto)) {
        unlink("../assets/perangkat/perangkat" . $foto); 
    }
    $foto = time() . '_' . basename($_FILES['foto']['name']);
    move_uploaded_file($_FILES['foto']['tmp_name'], "../assets/perangkat/perangkat" . $foto);
}

$sql = "UPDATE struktur_desa SET 
        nik='$nik',
        nama='$nama',
        tempat_lahir='$tempat_lahir',
        tanggal_lahir='$tanggal_lahir',
        jenis_kelamin='$jenis_kelamin',
        alamat='$alamat',
        no_hp='$no_hp',
        email='$email',
        jabatan='$jabatan',
        pendidikan='$pendidikan',
        mulai_jabatan='$mulai_jabatan',
        akhir_jabatan='$akhir_jabatan',
        status='$status',
        foto='$foto',
        keterangan='$keterangan'
        WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: ../views/backend_view/struktur_desa_index.php");
    exit;
} else {
    echo "Error: " . $conn->error;
}
