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

$pengumuman_id = $_GET['id'];


$stmt = $conn->prepare("SELECT * FROM pengumuman WHERE id = ?"); 
$stmt->bind_param("i", $pengumuman_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: home.php");
    exit;
}

$pengumuman = $result->fetch_assoc();
$stmt->close();

$profile_query = $conn->query("SELECT * FROM profile_desa LIMIT 1");
$profile = $profile_query->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pengumuman['judul']; ?> - Info Desa</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="../../assets/css/style.css"> 

    <style>
        
        .article-content {
            line-height: 1.8;
            font-size: 1.1rem;
            color: var(--bs-dark);
            margin-top: 20px;
        }
        .article-content p {
            margin-bottom: 1.5rem;
            text-align: justify;
        }
        .highlight-card {
            background-color: var(--bs-light);
            border-left: 5px solid var(--bs-secondary);
            border-radius: 8px;
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

<div class="container my-5 pt-5">
    
    <a href="home.php#pengumuman" class="btn btn-primary mb-4 rounded-pill">
        <i class="fas fa-arrow-left me-1"></i> Kembali ke Pengumuman
    </a>

    <div class="card shadow-lg border-0 p-lg-5 p-4">
        
        <h1 class="fw-bold text-primary mb-3"><?php echo $pengumuman['judul']; ?></h1>
        
        <div class="row g-2 p-3 highlight-card mb-4">
            <div class="col-12">
                <p class="text-secondary fw-bold mb-0">
                    <i class="fas fa-calendar-check me-2"></i> Tanggal Pelaksanaan:
                </p>
                <h4 class="fw-bolder text-primary">
                    <?php echo date('d F Y', strtotime($pengumuman['tanggal_pelaksanaan'])); ?>
                </h4>
            </div>
            <div class="col-12">
                <p class="text-muted small mb-0">
                    <i class="fas fa-clock me-2"></i> Diumumkan: <?php echo date('d M Y H:i', strtotime($pengumuman['created_at'])); ?> WIB
                </p>
            </div>
        </div>
        
        <div class="article-content">
            <?php echo nl2br($pengumuman['isi']); ?>
        </div>
        
        <hr class="my-5">

        <small class="text-end text-secondary">
            Terakhir Diperbarui: <?php echo date('d M Y H:i', strtotime($pengumuman['updated_at'])); ?>
        </small>
        
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