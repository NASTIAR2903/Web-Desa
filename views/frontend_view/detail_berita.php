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

$berita_id = $_GET['id'];


$stmt = $conn->prepare("SELECT * FROM berita WHERE id = ?");
$stmt->bind_param("i", $berita_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    
    header("Location: home.php");
    exit;
}

$berita = $result->fetch_assoc();
$stmt->close();

$profile_query = $conn->query("SELECT * FROM profile_desa LIMIT 1");
$profile = $profile_query->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $berita['judul']; ?> - Berita Desa</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="../../assets/css/style.css"> 

    <style>
        
        .article-content {
            line-height: 1.8;
            font-size: 1.1rem;
            color: var(--bs-dark);
            margin-top: 30px;
        }
        .article-content p {
            margin-bottom: 1.5rem;
            text-align: justify;
        }
        .article-image {
            max-height: 500px;
            object-fit: cover;
            width: 100%;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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
    
    <a href="home.php#berita" class="btn btn-primary mb-4 rounded-pill">
        <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Berita
    </a>

    <div class="card shadow-lg border-0 p-lg-5 p-4">
        
        <h1 class="fw-bold text-primary mb-3"><?php echo $berita['judul']; ?></h1>
        
        <p class="text-muted small mb-4">
            <i class="fas fa-calendar-alt me-1"></i> Dipublikasikan: <?php echo date('d F Y H:i', strtotime($berita['created_at'])); ?> WIB 
            </p>
        
        <?php if (!empty($berita['gambar'])): ?>
            <img src="../../assets/berita/<?php echo $berita['gambar']; ?>" 
                 alt="Gambar Berita <?php echo $berita['judul']; ?>" 
                 class="article-image mb-4">
        <?php endif; ?>
        
        <div class="article-content">
            <?php echo nl2br($berita['isi']);  ?>
        </div>
        
        <hr class="my-5">

        <small class="text-end text-secondary">
            Terakhir Diperbarui: <?php echo date('d M Y H:i', strtotime($berita['updated_at'])); ?>
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