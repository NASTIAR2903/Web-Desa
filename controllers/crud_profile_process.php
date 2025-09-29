<?php
session_start();
include "../config/db.php";


if (isset($_POST['save'])) {
    $id = $_POST['id'];
    $nama_desa = $_POST['nama_desa'];
    $alamat = $_POST['alamat'];
    $visi = $_POST['visi'];
    $misi = $_POST['misi'];
    $sejarah = $_POST['sejarah'];
    $luas_wilayah = $_POST['luas_wilayah'];
    $jumlah_penduduk = $_POST['jumlah_penduduk'];

    if ($id) {
        $sql = "UPDATE profile_desa SET 
                    nama_desa='$nama_desa', 
                    alamat='$alamat', 
                    visi='$visi', 
                    misi='$misi', 
                    sejarah='$sejarah',
                    luas_wilayah='$luas_wilayah',
                    jumlah_penduduk='$jumlah_penduduk'
                WHERE id=$id";
        if ($conn->query($sql)) {
            $_SESSION['msg'] = "Profil desa berhasil diperbarui!";
        } else {
            $_SESSION['msg'] = "Gagal update: " . $conn->error;
        }
    } else {
        
        $sql = "INSERT INTO profile_desa (nama_desa, alamat, visi, misi, sejarah, luas_wilayah, jumlah_penduduk) 
                VALUES ('$nama_desa', '$alamat', '$visi', '$misi', '$sejarah', '$luas_wilayah', '$jumlah_penduduk')";
        if ($conn->query($sql)) {
            $_SESSION['msg'] = "Profil desa berhasil ditambahkan!";
        } else {
            $_SESSION['msg'] = "Gagal tambah: " . $conn->error;
        }
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM profile_desa WHERE id=$id";
    if ($conn->query($sql)) {
        $_SESSION['msg'] = "Profil desa berhasil dihapus!";
    } else {
        $_SESSION['msg'] = "Gagal hapus: " . $conn->error;
    }
}

header("Location: ../views/backend_view/crud_profile.php");
exit;
