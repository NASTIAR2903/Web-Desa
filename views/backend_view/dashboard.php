<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../frontend_view/login.php");
    exit();   
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Web Desa</title>
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
        }
        
        
        .dashboard-card {
            border-radius: 0.5rem;
            box-shadow: 0 4px 8px rgba(0,0,0,.05);
            transition: transform 0.2s, box-shadow 0.2s;
            border: none;
        }

        .dashboard-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,.1);
        }

        .card-icon {
            font-size: 2.5rem;
            opacity: 0.7;
            margin-bottom: 15px;
        }

    </style>
</head>
<body>

<header class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fw-bold text-primary" href="#">
            Web Desa <span class="badge bg-primary">Admin</span>
        </a>
        
        <button class="navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="d-flex align-items-center ms-auto">
            <span class="text-dark me-3 d-none d-sm-inline">
                <i class="fas fa-user-circle me-1"></i> Halo, <?= 'Nama Admin';  ?>
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
                        <a class="nav-link active" href="dashboard.php">
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
                <h1 class="h2 text-dark">Dashboard Admin</h1>
            </div>

            <div class="row g-4"> 
                
                <div class="col-md-6 col-lg-4">
                    <div class="card dashboard-card h-100 border-secondary border-3 border-start">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-images text-secondary card-icon me-3"></i>
                                <div>
                                    <h5 class="card-title text-secondary fw-bold">Slider Hero</h5>
                                    <p class="card-text text-muted">Kelola gambar, judul, dan deskripsi di halaman utama.</p>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="slider_index.php" class="btn btn-sm btn-outline-secondary">Kelola <i class="fas fa-arrow-circle-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card dashboard-card h-100 border-primary border-3 border-start">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-book-open text-primary card-icon me-3"></i>
                                <div>
                                    <h5 class="card-title text-primary fw-bold">Profil Desa</h5>
                                    <p class="card-text text-muted">Kelola data profil dan informasi umum desa.</p>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="crud_profile.php" class="btn btn-sm btn-outline-primary">Kelola <i class="fas fa-arrow-circle-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card dashboard-card h-100 border-success border-3 border-start">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-users text-success card-icon me-3"></i>
                                <div>
                                    <h5 class="card-title text-success fw-bold">Struktur Desa</h5>
                                    <p class="card-text text-muted">Kelola daftar perangkat dan struktur organisasi desa.</p>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="struktur_desa_index.php" class="btn btn-sm btn-outline-success">Kelola <i class="fas fa-arrow-circle-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card dashboard-card h-100 border-info border-3 border-start">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-newspaper text-info card-icon me-3"></i>
                                <div>
                                    <h5 class="card-title text-info fw-bold">Berita Desa</h5>
                                    <p class="card-text text-muted">Kelola artikel, berita, dan kegiatan desa terbaru.</p>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="berita_index.php" class="btn btn-sm btn-outline-info">Kelola <i class="fas fa-arrow-circle-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card dashboard-card h-100 border-danger border-3 border-start">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-bullhorn text-danger card-icon me-3"></i>
                                <div>
                                    <h5 class="card-title text-danger fw-bold">Pengumuman</h5>
                                    <p class="card-text text-muted">Kelola pengumuman penting untuk warga desa.</p>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="pengumuman_index.php" class="btn btn-sm btn-outline-danger">Kelola <i class="fas fa-arrow-circle-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card dashboard-card h-100 border-warning border-3 border-start">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-user-check text-warning card-icon me-3"></i>
                                <div>
                                    <h5 class="card-title text-warning fw-bold">Verifikasi User</h5>
                                    <p class="card-text text-muted">Approve atau tolak permintaan pendaftaran user baru.</p>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="user_index.php" class="btn btn-sm btn-outline-warning">Kelola <i class="fas fa-arrow-circle-right ms-1"></i></a>
                            </div>
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