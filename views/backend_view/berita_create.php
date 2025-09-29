<?php

session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../frontend_view/login.php");
    exit();   
}

include "../../config/db.php";
$kategori = $conn->query("SELECT * FROM kategori_berita ORDER BY nama_kategori ASC");

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        :root {
            --sidebar-width: 250px;
        }

       
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1000;
            padding: 48px 0 0; 
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
            width: var(--sidebar-width);
            background-color: #343a40 !important;
        }
        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: .5rem;
            overflow-x: hidden;
            overflow-y: auto;
        }
        .sidebar .nav-link {
            font-weight: 500;
            color: #adb5bd;
            transition: color 0.2s, background-color 0.2s;
        }
        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            color: #ffffff;
            background-color: #0d6efd;
            border-radius: 5px;
        }
        .sidebar .nav-link svg, .sidebar .nav-link i {
            margin-right: 8px;
        }

        
        main {
            margin-left: var(--sidebar-width);
            padding-top: 56px;
            min-height: 100vh; 
        }
    </style>
</head>
<body>

<header class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fw-bold text-primary" href="dashboard.php">
            Web Desa <span class="badge bg-primary">Admin</span>
        </a>
        
        <button class="navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="d-flex align-items-center ms-auto">
            <span class="text-dark me-3 d-none d-sm-inline">
                <i class="fas fa-user-circle me-1"></i> Halo, <?= 'Nama Admin'; ?>
            </span>
            <a href="../../controllers/authentication/logout.php" class="btn btn-sm btn-outline-danger">
                <i class="fas fa-sign-out-alt me-1"></i> Logout
            </a>
        </div>
    </div>
</header>

<div class="container-fluid">
    <div class="row">

    <nav id="sidebarMenu" class="sidebar col-md-3 col-lg-2 d-md-block collapse">
            <div class="sidebar-sticky pt-3">
                <ul class="nav flex-column px-3">
                    
                    <li class="nav-item">
                        <a class="nav-link " href="dashboard.php">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="slider_index.php">
                            <i class="fas fa-images"></i> Slider Hero
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="crud_profile.php">
                            <i class="fas fa-book-open"></i> Profil Desa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="struktur_desa_index.php">
                            <i class="fas fa-users"></i> Struktur Desa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kategori_berita_index.php">
                            <i class="fas fa-th-list"></i> kategori Berita
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="berita_index.php">
                            <i class="fas fa-newspaper"></i> Berita Desa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pengumuman_index.php">
                            <i class="fas fa-bullhorn"></i> Pengumuman
                        </a>
                    </li>
                    
                    <hr class="text-light my-2"> 

                    <li class="nav-item">
                        <a class="nav-link" href="user_index.php">
                            <i class="fas fa-user-check"></i> Verifikasi User
                        </a>
                    </li>
                    
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
                <h1 class="h2 text-dark"><i class="fas fa-plus me-2 text-info"></i> Tambah Berita Baru</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="berita_index.php" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
                    </a>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <div class="card shadow-lg mb-4 border-info border-start border-4">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">Formulir Tambah Berita</h5>
                        </div>
                        <div class="card-body">
                            
                            <form action="../../controllers/berita_store.php" method="POST" enctype="multipart/form-data">
                                
                                <div class="mb-3">
                                    <label for="judul" class="form-label fw-bold">Judul Berita</label>
                                    <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan judul berita" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="kategori_id" class="form-label fw-bold">Kategori Berita</label>
                                    <select name="kategori_id" id="kategori_id" class="form-select" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        <?php while($row = $kategori->fetch_assoc()): ?>
                                            <option value="<?= $row['id']; ?>"><?= htmlspecialchars($row['nama_kategori']); ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="isi" class="form-label fw-bold">Isi Berita</label>
                                    <textarea name="isi" id="isi" rows="10" class="form-control" placeholder="Tuliskan isi berita di sini..." required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal_publikasi" class="form-label fw-bold">Tanggal Publikasi</label>
                                    <input type="date" name="tanggal_publikasi" id="tanggal_publikasi" 
                                        class="form-control" value="<?= date('Y-m-d'); ?>" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="gambar" class="form-label fw-bold">Gambar Utama</label>
                                    <input type="file" name="gambar" id="gambar" class="form-control">
                                    <small class="text-muted">Pilih gambar pendukung untuk berita (JPG/PNG).</small>
                                </div>
                                
                                <hr>

                                <button type="submit" class="btn btn-info text-white me-2">
                                    <i class="fas fa-save me-1"></i> Simpan Berita
                                </button>
                                <a href="berita_index.php" class="btn btn-outline-secondary">
                                    <i class="fas fa-times-circle me-1"></i> Batal
                                </a>
                            </form>

                        </div>
                    </div> </div>
            </div>
            
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>