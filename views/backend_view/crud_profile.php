<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../frontend_view/login.php");
    exit();   
}

include "../../config/db.php"; 


$sql = "SELECT * FROM profile_desa LIMIT 1";
$result = $conn->query($sql);
$profile = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Profil Desa</title>
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

        
        .preview-card {
            
            border: none;
            background-color: #ffffff; 
        }
        
        .preview-card h4.profile-title {
            color: var(--bs-primary); 
            border-bottom: 2px solid var(--bs-primary);
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        
        .stat-box {
            background-color: #f0f8ff; 
            border-left: 3px solid var(--bs-primary);
            padding: 10px;
            border-radius: 5px;
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
                <i class="fas fa-user-circle me-1"></i> Halo, <?= 'Nama Admin'; // Asumsi: Ganti dengan variabel PHP yang sebenarnya ?>
            </span>
            <a href="logout.php" class="btn btn-sm btn-outline-danger">
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
                        <a class="nav-link active" href="crud_profile.php">
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
                <h1 class="h2 text-dark"><i class="fas fa-book-open me-2 text-primary"></i> Kelola Profil Desa</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                     <a href="dashboard.php" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>

            <div class="row g-4">
                
                <div class="col-lg-6">
                    <div class="card shadow-sm mb-4 border-primary border-start border-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-edit me-1"></i> Edit Data Profil</h5>
                        </div>
                        <div class="card-body">
                            <?php if (isset($_SESSION['msg'])): ?>
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    <?= $_SESSION['msg']; unset($_SESSION['msg']); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <form action="../../controllers/crud_profile_process.php" method="POST">
                                <input type="hidden" name="id" value="<?= $profile['id'] ?? ''; ?>">

                                <div class="mb-3">
                                    <label for="nama_desa" class="form-label fw-bold">Nama Desa</label>
                                    <input type="text" class="form-control" id="nama_desa" name="nama_desa" required 
                                        value="<?= $profile['nama_desa'] ?? ''; ?>" placeholder="Masukkan nama desa">
                                </div>

                                <div class="mb-3">
                                    <label for="alamat" class="form-label fw-bold">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" required rows="3" placeholder="Masukkan alamat lengkap"><?= $profile['alamat'] ?? ''; ?></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="visi" class="form-label fw-bold">Visi</label>
                                    <textarea class="form-control" id="visi" name="visi" rows="4" placeholder="Masukkan visi desa"><?= $profile['visi'] ?? ''; ?></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="misi" class="form-label fw-bold">Misi</label>
                                    <textarea class="form-control" id="misi" name="misi" rows="4" placeholder="Masukkan misi desa"><?= $profile['misi'] ?? ''; ?></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="sejarah" class="form-label fw-bold">Sejarah</label>
                                    <textarea class="form-control" id="sejarah" name="sejarah" rows="6" placeholder="Masukkan sejarah singkat desa"><?= $profile['sejarah'] ?? ''; ?></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="luas_wilayah" class="form-label fw-bold">Luas Wilayah (contoh: 1000 Ha)</label>
                                    <input type="text" class="form-control" id="luas_wilayah" name="luas_wilayah" 
                                        value="<?= $profile['luas_wilayah'] ?? ''; ?>" placeholder="Masukkan luas wilayah">
                                </div>

                                <div class="mb-3">
                                    <label for="jumlah_penduduk" class="form-label fw-bold">Jumlah Penduduk</label>
                                    <input type="number" class="form-control" id="jumlah_penduduk" name="jumlah_penduduk" 
                                        value="<?= $profile['jumlah_penduduk'] ?? ''; ?>" placeholder="Masukkan jumlah penduduk">
                                </div>
                                
                                <hr>

                                <button type="submit" name="save" class="btn btn-primary me-2">
                                    <i class="fas fa-save me-1"></i> Simpan Perubahan
                                </button>
                                <?php if (!empty($profile)): ?>
                                    <button type="submit" name="delete" class="btn btn-outline-danger" onclick="return confirm('Anda yakin ingin menghapus data profil desa? Tindakan ini tidak bisa dibatalkan!')">
                                        <i class="fas fa-trash-alt me-1"></i> Hapus
                                    </button>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="card shadow-sm mb-4 border-secondary border-start border-4">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0"><i class="fas fa-eye me-1"></i> Preview Tampilan Publik</h5>
                        </div>
                        <div class="card-body preview-card p-4">
                            <?php if ($profile): ?>
                                <h4 class="profile-title text-uppercase"><?= $profile['nama_desa']; ?></h4>
                                
                                <p class="text-muted mb-4"><i class="fas fa-map-marker-alt me-2 text-primary"></i> Alamat: <?= $profile['alamat']; ?></p>

                                <div class="row g-3 mb-4">
                                    <div class="col-6">
                                        <div class="stat-box">
                                            <p class="mb-0 text-muted small"><i class="fas fa-globe me-1"></i> Luas Wilayah</p>
                                            <p class="fw-bold fs-5 text-primary"><?= $profile['luas_wilayah'] ?? '-'; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="stat-box">
                                            <p class="mb-0 text-muted small"><i class="fas fa-users me-1"></i> Jumlah Penduduk</p>
                                            <p class="fw-bold fs-5 text-primary"><?= $profile['jumlah_penduduk'] ?? '-'; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <?php if (!empty($profile['visi'])): ?>
                                    <h5 class="mt-3 text-dark border-bottom pb-1">Visi Desa</h5>
                                    <p class="mb-3 text-secondary fst-italic"><i class="fas fa-quote-left me-2 text-primary"></i><?= nl2br($profile['visi']); ?></p>
                                <?php endif; ?>

                                <?php if (!empty($profile['misi'])): ?>
                                    <h5 class="mt-3 text-dark border-bottom pb-1">Misi Desa</h5>
                                    <p class="mb-3 text-secondary fst-italic"><i class="fas fa-bullseye me-2 text-primary"></i><?= nl2br($profile['misi']); ?></p>
                                <?php endif; ?>

                                <hr class="my-4">

                                <?php if (!empty($profile['sejarah'])): ?>
                                    <h5 class="mt-3 text-dark border-bottom pb-1">Sejarah Desa</h5>
                                    <p class="text-secondary"><?= nl2br($profile['sejarah']); ?></p>
                                <?php endif; ?>

                            <?php else: ?>
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle me-1"></i> Data profil desa belum tersedia. Silakan isi formulir di samping untuk mulai.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>