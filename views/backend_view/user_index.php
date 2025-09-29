<?php
session_start();
include "../../config/db.php";

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../frontend_view/login.php");
    exit();   
}

$sql = "SELECT * FROM users ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Users & Verifikasi</title>
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

        
        .table-verif td {
            vertical-align: middle;
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
                <i class="fas fa-user-circle me-1"></i> Halo, <?= $_SESSION['user']['name'] ?? 'Admin'; ?>
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
                        <a class="nav-link" href="dashboard.php">
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
                        <a class="nav-link active" href="crud_users.php">
                            <i class="fas fa-user-check"></i> Verifikasi User
                        </a>
                    </li>
                    
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
                <h1 class="h2 text-dark"><i class="fas fa-user-check me-2 text-warning"></i> Manajemen Users & Verifikasi</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="dashboard.php" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card shadow-lg mb-4 border-warning border-start border-4">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0">Daftar Users (Warga)</h5>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-verif">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>NIK</th>
                                            <th>Pekerjaan</th>
                                            <th>Tgl Lahir</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Role</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($user = $result->fetch_assoc()) : ?>
                                            <tr>
                                                <td class="fw-bold"><?= htmlspecialchars($user['name']) ?></td>
                                                <td><?= htmlspecialchars($user['email']) ?></td>
                                                <td><?= htmlspecialchars($user['nik']) ?></td>
                                                <td><?= htmlspecialchars($user['pekerjaan']) ?></td>
                                                <td><?= htmlspecialchars($user['tanggal_lahir']) ?></td>
                                                <td class="text-center">
                                                    <?php if ($user['status'] == 'approved'): ?>
                                                        <span class="badge bg-success">Approved</span>
                                                    <?php elseif ($user['status'] == 'pending'): ?>
                                                        <span class="badge bg-warning text-dark">Pending</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-danger">Rejected</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-secondary"><?= ucfirst($user['role']) ?></span>
                                                </td>
                                                <td class="text-center">
                                                    <?php if ($user['status'] == 'pending'): ?>
                                                        <a href="../../controllers/approve_user.php?id=<?= $user['id'] ?>" 
                                                            class="btn btn-success btn-sm me-1"
                                                            onclick="return confirm('Approve user <?= htmlspecialchars($user['name']) ?>?')">
                                                            <i class="fas fa-check"></i> Approve
                                                        </a>
                                                        <a href="../../controllers/reject_user.php?id=<?= $user['id'] ?>" 
                                                            class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Tolak user <?= htmlspecialchars($user['name']) ?>?')">
                                                            <i class="fas fa-times"></i> Reject
                                                        </a>
                                                    <?php else: ?>
                                                        <em class="text-muted small">Tidak ada aksi</em>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div> </div>
                    </div> </div>
            </div>
            
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>