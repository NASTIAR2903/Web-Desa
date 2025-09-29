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
    <title>Tambah Perangkat Desa</title>
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
                <h1 class="h2 text-dark"><i class="fas fa-plus me-2 text-primary"></i> Tambah Perangkat Desa</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="struktur_desa_index.php" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
                    </a>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">

                    <div class="card shadow-lg mb-4 border-success border-start border-4">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">Formulir Data Perangkat Baru</h5>
                        </div>
                        <div class="card-body p-4">
                            
                            <form action="../../controllers/struktur_desa_store.php" method="POST" enctype="multipart/form-data">
                                
                                <div class="row">
                                    
                                    <div class="col-md-6 border-end pe-md-4">
                                        <h6 class="text-success mb-3"><i class="fas fa-id-card me-1"></i> Data Personal</h6>

                                        <div class="mb-3">
                                            <label for="nik" class="form-label fw-bold">NIK</label>
                                            <input type="number" name="nik" id="nik" class="form-control" placeholder="Masukkan NIK perangkat" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="nama" class="form-label fw-bold">Nama Lengkap</label>
                                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama perangkat" required>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="tempat_lahir" class="form-label fw-bold">Tempat Lahir</label>
                                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" placeholder="Contoh: Bandung">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="tanggal_lahir" class="form-label fw-bold">Tanggal Lahir</label>
                                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Jenis Kelamin</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk1" value="Laki-laki">
                                                <label class="form-check-label" for="jk1">Laki-laki</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk2" value="Perempuan">
                                                <label class="form-check-label" for="jk2">Perempuan</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 ps-md-4">
                                        <h6 class="text-success mb-3"><i class="fas fa-briefcase me-1"></i> Data Jabatan & Kontak</h6>

                                        <div class="mb-3">
                                            <label for="jabatan" class="form-label fw-bold">Jabatan</label>
                                            <select name="jabatan" id="jabatan" class="form-select" required>
                                                <option value="">-- Pilih Jabatan --</option>
                                                <option value="Kepala Desa">Kepala Desa</option>
                                                <option value="Sekretaris Desa">Sekretaris Desa</option>
                                                <option value="Bendahara">Bendahara</option>
                                                <option value="Kasi Pemerintahan">Kasi Pemerintahan</option>
                                                <option value="Kasi Kesejahteraan">Kasi Kesejahteraan</option>
                                                <option value="Kadus">Kepala Dusun</option>
                                            </select>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="mulai_jabatan" class="form-label fw-bold">Mulai Jabatan</label>
                                                <input type="date" name="mulai_jabatan" id="mulai_jabatan" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="akhir_jabatan" class="form-label fw-bold">Akhir Jabatan</label>
                                                <input type="date" name="akhir_jabatan" id="akhir_jabatan" class="form-control">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="pendidikan" class="form-label fw-bold">Pendidikan Terakhir</label>
                                            <select name="pendidikan" id="pendidikan" class="form-select">
                                                <option value="">-- Pilih Pendidikan --</option>
                                                <option value="SD">SD</option>
                                                <option value="SMP">SMP</option>
                                                <option value="SMA/SMK">SMA/SMK</option>
                                                <option value="D3">D3</option>
                                                <option value="S1">S1</option>
                                                <option value="S2">S2</option>
                                                <option value="S3">S3</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="no_hp" class="form-label fw-bold">Nomor HP</label>
                                            <input type="tel" name="no_hp" id="no_hp" class="form-control" placeholder="08xxxx">
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label fw-bold">Email</label>
                                            <input type="email" name="email" id="email" class="form-control" placeholder="contoh@email.com">
                                        </div>
                                    </div>
                                    
                                </div> <hr class="my-4">
                                
                                <div class="mb-3">
                                    <label for="alamat" class="form-label fw-bold">Alamat Lengkap</label>
                                    <textarea name="alamat" id="alamat" class="form-control" rows="2" placeholder="Alamat lengkap perangkat"></textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label fw-bold">Keterangan Tambahan</label>
                                    <textarea name="keterangan" id="keterangan" class="form-control" rows="2"></textarea>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="status" class="form-label fw-bold">Status</label>
                                        <select name="status" id="status" class="form-select">
                                            <option value="Aktif">Aktif</option>
                                            <option value="Nonaktif">Nonaktif</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="foto" class="form-label fw-bold">Foto Perangkat</label>
                                        <input type="file" name="foto" id="foto" class="form-control">
                                        <small class="text-muted">Format: JPG, PNG. Maksimal 2MB.</small>
                                    </div>
                                </div>
                                
                                <hr class="mt-4">

                                <button type="submit" class="btn btn-success me-2">
                                    <i class="fas fa-save me-1"></i> Simpan Data
                                </button>
                                <a href="crud_struktur.php" class="btn btn-outline-secondary">
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