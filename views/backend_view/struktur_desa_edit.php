<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../frontend_view/login.php");
    exit();   
}


include "../../config/db.php";

$id = $_GET['id']; 
$sql = "SELECT * FROM struktur_desa WHERE id = $id";
$result = $conn->query($sql);
$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Perangkat Desa: <?= $data['nama'] ?? 'Data Tidak Ditemukan'; ?></title>
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

        
        .form-foto-preview {
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
                <h1 class="h2 text-dark"><i class="fas fa-edit me-2 text-warning"></i> Edit Perangkat Desa: <span class="text-primary"><?= $data['nama'] ?? ''; ?></span></h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="struktur_desa_index.php" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
                    </a>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">

                    <div class="card shadow-lg mb-4 border-warning border-start border-4">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0">Formulir Edit Data</h5>
                        </div>
                        <div class="card-body p-4">
                            
                        <form action="../../controllers/struktur_desa_update.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $data['id']; ?>">
                            
                            <div class="row">
                                <div class="col-md-6 border-end pe-md-4">
                                    <h6 class="text-warning mb-3"><i class="fas fa-id-card me-1"></i> Data Personal</h6>

                                    <div class="mb-3">
                                        <label for="nik" class="form-label fw-bold">NIK</label>
                                        <input type="text" name="nik" id="nik" class="form-control" value="<?= $data['nik']; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="nama" class="form-label fw-bold">Nama Lengkap</label>
                                        <input type="text" name="nama" id="nama" class="form-control" value="<?= $data['nama']; ?>" required>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="tempat_lahir" class="form-label fw-bold">Tempat Lahir</label>
                                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="<?= $data['tempat_lahir']; ?>">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="tanggal_lahir" class="form-label fw-bold">Tanggal Lahir</label>
                                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="<?= $data['tanggal_lahir']; ?>">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="jenis_kelamin" class="form-label fw-bold">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-select">
                                            <option value="Laki-laki" <?= $data['jenis_kelamin']=='Laki-laki'?'selected':''; ?>>Laki-laki</option>
                                            <option value="Perempuan" <?= $data['jenis_kelamin']=='Perempuan'?'selected':''; ?>>Perempuan</option>
                                        </select>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="pendidikan" class="form-label fw-bold">Pendidikan Terakhir</label>
                                        <input type="text" name="pendidikan" id="pendidikan" class="form-control" value="<?= $data['pendidikan']; ?>">
                                    </div>
                                </div>

                                <div class="col-md-6 ps-md-4">
                                    <h6 class="text-warning mb-3"><i class="fas fa-briefcase me-1"></i> Data Jabatan & Kontak</h6>

                                    <div class="mb-3">
                                        <label for="jabatan" class="form-label fw-bold">Jabatan</label>
                                        <input type="text" name="jabatan" id="jabatan" class="form-control" value="<?= $data['jabatan']; ?>" required>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="mulai_jabatan" class="form-label fw-bold">Mulai Jabatan</label>
                                            <input type="date" name="mulai_jabatan" id="mulai_jabatan" class="form-control" value="<?= $data['mulai_jabatan']; ?>">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="akhir_jabatan" class="form-label fw-bold">Akhir Jabatan</label>
                                            <input type="date" name="akhir_jabatan" id="akhir_jabatan" class="form-control" value="<?= $data['akhir_jabatan']; ?>">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="status" class="form-label fw-bold">Status</label>
                                        <select name="status" id="status" class="form-select">
                                            <option value="Aktif" <?= $data['status']=='Aktif'?'selected':''; ?>>Aktif</option>
                                            <option value="Nonaktif" <?= $data['status']=='Nonaktif'?'selected':''; ?>>Nonaktif</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="no_hp" class="form-label fw-bold">Nomor HP</label>
                                        <input type="text" name="no_hp" id="no_hp" class="form-control" value="<?= $data['no_hp']; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label fw-bold">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" value="<?= $data['email']; ?>">
                                    </div>
                                </div>
                            </div> <hr class="my-4">
                            
                            <div class="mb-3">
                                <label for="alamat" class="form-label fw-bold">Alamat Lengkap</label>
                                <textarea name="alamat" id="alamat" class="form-control" rows="2"><?= $data['alamat']; ?></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label for="keterangan" class="form-label fw-bold">Keterangan Tambahan</label>
                                <textarea name="keterangan" id="keterangan" class="form-control" rows="2"><?= $data['keterangan']; ?></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label for="foto" class="form-label fw-bold">Foto Saat Ini</label><br>
                                <?php if (!empty($data['foto'])): ?>
                                    <img src="../../assets/perangkat/perangkat<?= $data['foto']; ?>" alt="Foto Perangkat" width="100" height="100" class="mb-2 form-foto-preview">
                                    <input type="hidden" name="old_foto" value="<?= $data['foto']; ?>">
                                <?php else: ?>
                                    <p class="text-muted small">Belum ada foto terunggah.</p>
                                <?php endif; ?>
                                
                                <label for="foto" class="form-label fw-bold mt-2">Ganti Foto (Opsional)</label>
                                <input type="file" name="foto" id="foto" class="form-control">
                                <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
                            </div>

                            <hr class="mt-4">

                            <button type="submit" class="btn btn-warning me-2">
                                <i class="fas fa-sync-alt me-1"></i> Update Data
                            </button>
                            <a href="crud_struktur.php" class="btn btn-outline-secondary">
                                <i class="fas fa-times-circle me-1"></i> Batal
                            </a>
                        </form>


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