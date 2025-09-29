<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../frontend_view/login.php");
    exit();   
}

include "../../config/db.php";
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM slider_hero WHERE id=$id");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Slider Hero: <?= htmlspecialchars($row['judul'] ?? 'N/A'); ?></title>
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

        
        .form-gambar-preview {
            border-radius: 8px;
            border: 1px solid #ddd;
            object-fit: cover;
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
                        <a class="nav-link active" href="slider_index.php">
                            <i class="fas fa-images"></i> Slider Hero
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="crud_profile.php">
                            <i class="fas fa-book-open"></i> Profil Desa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="struktur_desa_index.php">
                            <i class="fas fa-users"></i> Struktur Desa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="berita_index.php">
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
                <h1 class="h2 text-dark"><i class="fas fa-edit me-2 text-warning"></i> Edit Slider Hero: <span class="text-secondary"><?= htmlspecialchars($row['judul'] ?? ''); ?></span></h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="slider_index.php" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
                    </a>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <div class="card shadow-lg mb-4 border-warning border-start border-4">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0">Formulir Edit Slider</h5>
                        </div>
                        <div class="card-body">
                            
                            <form action="../../controllers/slider_update.php" method="POST" enctype="multipart/form-data">
                                
                                <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                <input type="hidden" name="gambar_lama" value="<?= $row['gambar']; ?>">

                                <div class="mb-3">
                                    <label for="judul" class="form-label fw-bold">Judul</label>
                                    <input type="text" name="judul" id="judul" class="form-control" value="<?= htmlspecialchars($row['judul'] ?? ''); ?>" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                                    <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control"><?= htmlspecialchars($row['deskripsi'] ?? ''); ?></textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Gambar Saat Ini</label><br>
                                    <?php if($row['gambar']): ?>
                                        <img src="../../assets/sliders/<?= $row['gambar']; ?>" alt="Gambar Slider" width="200" height="100" class="mb-2 form-gambar-preview">
                                    <?php else: ?>
                                        <p class="text-muted small">Tidak ada gambar terunggah.</p>
                                    <?php endif; ?>
                                    
                                    <label for="gambar" class="form-label fw-bold mt-2">Ganti Gambar (Opsional)</label>
                                    <input type="file" name="gambar" id="gambar" class="form-control">
                                    <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
                                </div>
                                
                                <hr>

                                <button type="submit" class="btn btn-warning me-2">
                                    <i class="fas fa-sync-alt me-1"></i> Update Slider
                                </button>
                                <a href="slider_index.php" class="btn btn-outline-secondary">
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