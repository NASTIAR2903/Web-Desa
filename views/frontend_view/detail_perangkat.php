<?php
session_start();

if (!isset($_SESSION['user'])) {
    
    header("Location: ../../index.php"); 
    exit;
}


if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
   
    header("Location: home.php"); 
    exit;
}


include "../../config/db.php"; 

$perangkat_id = $_GET['id'];


$stmt = $conn->prepare("SELECT * FROM struktur_desa WHERE id = ?");
$stmt->bind_param("i", $perangkat_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
   
    header("Location: home.php");
    exit;
}

$perangkat = $result->fetch_assoc();
$stmt->close();

$profile_query = $conn->query("SELECT * FROM profile_desa LIMIT 1");
$profile = $profile_query->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata <?php echo $perangkat['nama']; ?> - Desa <?php echo $profile['nama_desa'] ?? 'Kita'; ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="../../assets/css/style.css"> 

    <style>
        
        .header-detail {
            background-color: var(--bs-primary);
            color: white;
            padding: 60px 0;
            margin-top: 56px; 
        }
        .profile-photo {
            width: 200px;
            height: 250px;
            object-fit: cover;
            border: 5px solid white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .info-label {
            display: inline-block;
            width: 150px; 
            font-weight: 600;
            color: var(--bs-primary);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: var(--bs-primary);">
    <div class="container">
        <a class="navbar-brand fw-bold" href="home.php"><i class="fas fa-landmark me-2"></i>Desa <?php echo $profile['nama_desa'] ?? 'Kita'; ?></a>
        <div class="d-flex ms-auto align-items-center">
            <a href="home.php" class="btn btn-sm btn-outline-light me-2 rounded-pill d-none d-lg-inline-block">
                <i class="fas fa-home me-1"></i> Beranda
            </a>
            <a href="../../controllers/authentication/logout.php" class="btn btn-danger rounded-pill">
                <i class="fas fa-sign-out-alt me-1"></i> Logout
            </a>
        </div>
    </div>
</nav>

<div class="header-detail">
    <div class="container text-center">
        <img src="../../assets/perangkat/perangkat<?php echo $perangkat['foto'] ?? 'default.png'; ?>" 
             class="profile-photo rounded-3 mb-3" alt="<?php echo $perangkat['nama']; ?>">
        <h1 class="display-5 fw-bold"><?php echo $perangkat['nama']; ?></h1>
        <p class="lead text-warning"><?php echo $perangkat['jabatan']; ?></p>
        
        <a href="home.php#struktur" class="btn btn-sm btn-secondary mt-3">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Struktur
        </a>
    </div>
</div>

<div class="container my-5">
    <div class="row g-4">
        
        <div class="col-lg-6">
            <div class="card shadow-sm h-100 p-4" style="border-top: 5px solid var(--bs-secondary);">
                <h4 class="fw-bold text-secondary mb-4"><i class="fas fa-user-circle me-2"></i> Data Pribadi</h4>
                
                <p><span class="info-label">NIK:</span> <?php echo $perangkat['nik'] ?? '-'; ?></p>
                <p><span class="info-label">Tempat/Tgl Lahir:</span> <?php echo ($perangkat['tempat_lahir'] ?? '-') . ', ' . (date('d M Y', strtotime($perangkat['tanggal_lahir'])) ?? '-'); ?></p>
                <p><span class="info-label">Jenis Kelamin:</span> <?php echo $perangkat['jenis_kelamin'] ?? '-'; ?></p>
                <p><span class="info-label">Pendidikan Terakhir:</span> <?php echo $perangkat['pendidikan'] ?? '-'; ?></p>
                <p><span class="info-label">Alamat:</span> <?php echo nl2br($perangkat['alamat'] ?? '-'); ?></p>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm h-100 p-4" style="border-top: 5px solid var(--bs-primary);">
                <h4 class="fw-bold text-primary mb-4"><i class="fas fa-briefcase me-2"></i> Data Jabatan & Kontak</h4>
                
                <p><span class="info-label">Jabatan:</span> <?php echo $perangkat['jabatan']; ?></p>
                <p><span class="info-label">Mulai Jabatan:</span> <?php echo date('d M Y', strtotime($perangkat['mulai_jabatan'])) ?? '-'; ?></p>
                <p><span class="info-label">Akhir Jabatan:</span> <?php echo ($perangkat['akhir_jabatan'] ? date('d M Y', strtotime($perangkat['akhir_jabatan'])) : 'Selesai ' . (date('Y') + 4)) ?? '-'; ?></p>
                <p><span class="info-label">Status:</span> 
                    <span class="badge bg-<?php echo ($perangkat['status'] == 'Aktif' ? 'success' : 'danger'); ?>">
                        <?php echo $perangkat['status']; ?>
                    </span>
                </p>
                
                <hr>

                <p><span class="info-label"><i class="fas fa-phone me-1"></i> No. HP:</span> <?php echo $perangkat['no_hp'] ?? '-'; ?></p>
                <p><span class="info-label"><i class="fas fa-envelope me-1"></i> Email:</span> <?php echo $perangkat['email'] ?? '-'; ?></p>
            </div>
        </div>
        
        <div class="col-12 mt-4">
            <div class="card shadow-sm p-4">
                <h5 class="fw-bold text-dark mb-3"><i class="fas fa-info-circle me-2"></i> Keterangan Tambahan</h5>
                <p class="text-muted"><?php echo nl2br($perangkat['keterangan'] ?? 'Tidak ada keterangan tambahan.'); ?></p>
            </div>
        </div>

    </div>
</div>

<footer class="bg-dark text-white text-center py-4 mt-5">
    <div class="container">
        <p class="mb-0">&copy; <?php echo date("Y"); ?> Pemerintah Desa <?php echo $profile['nama_desa'] ?? 'Kita'; ?>. Semua Hak Dilindungi.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>