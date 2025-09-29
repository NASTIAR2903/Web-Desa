<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../frontend_view/login.php");
    exit();   
}


include "../../config/db.php";

if (!isset($_GET['id'])) {
    header("Location: struktur_desa_index.php"); 
    exit;
}

$id = $_GET['id'];

$sql = "SELECT * FROM struktur_desa WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    header("Location: ../backend_view/struktur_desa_index.php");
    exit(); 
}

$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Perangkat Desa: <?= htmlspecialchars($data['nama'] ?? ''); ?></title>
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
        
        
        .img-profile {
            border: 4px solid var(--bs-primary);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            object-fit: cover;
        }

        .info-label {
            color: var(--bs-secondary);
            font-size: 0.9rem;
            display: block;
        }

        .info-value {
            font-weight: 500;
            word-break: break-word;
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
                        <a class="nav-link" href="crud_profile.php">
                            <i class="fas fa-book-open"></i> Profil Desa
                        </a>
                    </li>
                    <li class="nav-item active">
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
                <h1 class="h2 text-dark"><i class="fas fa-user-tie me-2 text-primary"></i> Detail Perangkat Desa</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="struktur_desa_index.php" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
                    </a>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    
                    <?php if ($result->num_rows == 0): ?>
                        <div class="alert alert-danger" role="alert">
                            <h3>Data perangkat desa tidak ditemukan.</h3>
                        </div>
                    <?php else: ?>
                        <div class="card shadow-lg border-primary">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0 fw-bold"><?= htmlspecialchars($data['nama'] ?? 'N/A'); ?></h4>
                                <span class="badge bg-light text-primary fs-6"><?= htmlspecialchars($data['jabatan'] ?? 'N/A'); ?></span>
                            </div>
                            
                            <div class="card-body p-4">
                                <div class="row">
                                    
                                    <div class="col-md-4 text-center border-end mb-4 mb-md-0">
                                        <h6 class="text-primary mb-3">Foto Perangkat</h6>
                                        <?php if (!empty($data['foto'])): ?>
                                            <img src="../../assets/perangkat/perangkat<?= $data['foto']; ?>" alt="Foto <?= htmlspecialchars($data['nama']); ?>" 
                                                 class="img-fluid rounded-circle img-profile mb-3" style="width:150px; height:150px;">
                                        <?php else: ?>
                                            <div class="bg-light text-secondary d-flex align-items-center justify-content-center rounded-circle img-profile mx-auto mb-3" style="width:150px; height:150px; font-size: 3rem;">
                                                <i class="fas fa-user-slash"></i>
                                            </div>
                                        <?php endif; ?>

                                        <div class="mt-2">
                                            <span class="info-label">Status Jabatan:</span>
                                            <?php if (($data['status'] ?? '') == "Aktif"): ?>
                                                <span class="badge bg-success fs-6">Aktif</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger fs-6">Nonaktif</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-md-8 ps-md-4">
                                        <h6 class="text-primary mb-3"><i class="fas fa-info-circle me-1"></i> Informasi Lengkap</h6>
                                        
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <span class="info-label">NIK</span>
                                                <span class="info-value"><?= htmlspecialchars($data['nik'] ?? '-'); ?></span>
                                            </div>
                                            <div class="col-md-8">
                                                <span class="info-label">TTL</span>
                                                <span class="info-value"><?= htmlspecialchars($data['tempat_lahir'] ?? '-'); ?>, <?= htmlspecialchars($data['tanggal_lahir'] ?? '-'); ?></span>
                                            </div>
                                            <div class="col-md-4">
                                                <span class="info-label">Jenis Kelamin</span>
                                                <span class="info-value"><?= htmlspecialchars($data['jenis_kelamin'] ?? '-'); ?></span>
                                            </div>
                                            <div class="col-md-8">
                                                <span class="info-label">Pendidikan Terakhir</span>
                                                <span class="info-value"><?= htmlspecialchars($data['pendidikan'] ?? '-'); ?></span>
                                            </div>
                                            
                                            <hr class="my-2">
                                            
                                            <div class="col-md-6">
                                                <span class="info-label"><i class="fas fa-phone-alt"></i> No HP</span>
                                                <span class="info-value"><?= htmlspecialchars($data['no_hp'] ?? '-'); ?></span>
                                            </div>
                                            <div class="col-md-6">
                                                <span class="info-label"><i class="fas fa-envelope"></i> Email</span>
                                                <span class="info-value"><?= htmlspecialchars($data['email'] ?? '-'); ?></span>
                                            </div>
                                            
                                            <hr class="my-2">

                                            <div class="col-12">
                                                <span class="info-label"><i class="fas fa-calendar-alt"></i> Masa Jabatan</span>
                                                <span class="info-value"><?= htmlspecialchars($data['mulai_jabatan'] ?? '-'); ?> s/d <?= htmlspecialchars($data['akhir_jabatan'] ?? '-'); ?></span>
                                            </div>

                                            <div class="col-12 mt-3">
                                                <span class="info-label"><i class="fas fa-map-marker-alt"></i> Alamat</span>
                                                <p class="info-value"><?= nl2br(htmlspecialchars($data['alamat'] ?? '-')); ?></p>
                                            </div>
                                        </div>

                                        <div class="mt-4 pt-3 border-top">
                                            <span class="info-label">Keterangan:</span>
                                            <p class="small text-muted"><?= nl2br(htmlspecialchars($data['keterangan'] ?? 'Tidak ada keterangan.')); ?></p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-footer bg-light text-end">
                                <small class="text-muted me-3">Dibuat: <?= htmlspecialchars($data['created_at'] ?? '-'); ?> | Diperbarui: <?= htmlspecialchars($data['updated_at'] ?? '-'); ?></small>
                                <a href="struktur_desa_edit.php?id=<?= $data['id']; ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a>
                                <a href="../../controllers/struktur_desa_delete.php?id=<?= $data['id']; ?>" 
                                   onclick="return confirm('Yakin ingin menghapus data ini?')" 
                                   class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt me-1"></i> Hapus
                                </a>
                            </div>
                        </div> <?php endif; ?>
                </div>
            </div>
            
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>