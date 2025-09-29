<?php
include "config/db.php";


$profile = $conn->query("SELECT * FROM profile_desa LIMIT 1")->fetch_assoc();


$struktur = $conn->query("SELECT * FROM struktur_desa");



$slides_query = $conn->query("SELECT * FROM slider_hero ORDER BY id ASC");
$slides = $slides_query->fetch_all(MYSQLI_ASSOC);
$total_slides = count($slides);


if ($total_slides === 0) {
    $slides = [
        [
            'judul' => 'Membangun Bersama, Maju Bersama ' . ($profile['nama_desa'] ?? 'Desa Kita'),
            'deskripsi' => 'Pusat Informasi Resmi Pemerintah Desa dan Layanan Masyarakat',
            'gambar' => 'bg-desa.jpg' 
        ],
    ];
    $total_slides = 1;
}

$stats = [
    ['icon' => 'fa-users', 'label' => 'Jumlah Penduduk', 'value' => number_format($profile['jumlah_penduduk'] ?? 0) . ' jiwa', 'color' => 'text-primary'],
    ['icon' => 'fa-chart-area', 'label' => 'Luas Wilayah', 'value' => ($profile['luas_wilayah'] ?? 0) . ' km²', 'color' => 'text-warning'],
    ['icon' => 'fa-map-marker-alt', 'label' => 'Alamat Kantor', 'value' => $profile['alamat'] ?? 'Belum Tersedia', 'color' => 'text-success'],
];

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa <?php echo $profile['nama_desa'] ?? 'Kita Tercinta'; ?> - Website Resmi</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
    
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: var(--bs-primary);">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#"><i class="fas fa-landmark me-2"></i>Desa <?php echo $profile['nama_desa'] ?? 'Kita'; ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" 
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#hero">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#profil">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#struktur">Struktur</a>
                </li>
            </ul>

            <div class="d-flex ms-auto d-none d-lg-flex">
                <a href="views/frontend_view/register.php" class="btn btn-outline-light me-2 rounded-pill">
                    <i class="fas fa-user-plus me-1"></i> Register
                </a>
                <a href="views/frontend_view/login.php" class="btn btn-secondary rounded-pill">
                    <i class="fas fa-sign-in-alt me-1"></i> Login
                </a>
            </div>

            <ul class="navbar-nav d-lg-none mt-2">
                 <li class="nav-item">
                    <a class="nav-link" href="views/frontend_view/register.php"><i class="fas fa-user-plus me-2"></i> Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="views/frontend_view/login.php"><i class="fas fa-sign-in-alt me-2"></i> Login</a>
                </li>
            </ul>

        </div>
    </div>
</nav>

<section class="hero" id="hero">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        
        <div class="carousel-inner">
            
            <?php $i = 0; ?>
            <?php foreach ($slides as $slide): ?>
                <div class="carousel-item <?php echo ($i === 0) ? 'active' : ''; ?>" 
                     style="background-image: url('assets/sliders/<?php echo $slide['gambar']; ?>');">
                    
                    <div class="carousel-overlay"></div>
                    
                    <div class="carousel-caption carousel-caption-centered">
                        <h1 class="display-3"><?php echo $slide['judul']; ?></h1>
                        <p class="lead"><?php echo $slide['deskripsi']; ?></p>
                        
                        <a href="views/frontend_view/login.php" class="btn btn-secondary btn-lg mt-3 fw-bold rounded-pill shadow-lg">
                            Dapatkan Informasi <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            <?php $i++; ?>
            <?php endforeach; ?>

        </div>
        
    </div>
</section>


<div class="container my-5 py-3" id="profil">
    <h2 class="text-center section-title">Profil Desa</h2>

    <div class="row g-4 mb-5">
        
        <div class="col-md-6">
            <div class="card shadow-lg border-0 h-100 p-4" style="border-left: 5px solid var(--bs-secondary); background-color: white;">
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-bullseye fa-3x me-3 text-secondary"></i>
                    <h4 class="fw-bold text-primary mb-0">Visi Desa</h4>
                </div>
                <p class="card-text text-muted fst-italic">"<?php echo $profile['visi'] ?? 'Visi desa belum ditetapkan.'; ?>"</p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-lg border-0 h-100 p-4" style="border-left: 5px solid var(--bs-primary); background-color: white;">
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-handshake fa-3x me-3 text-primary"></i>
                    <h4 class="fw-bold text-secondary mb-0">Misi Desa</h4>
                </div>
                <p class="card-text text-muted"><?php echo nl2br($profile['misi'] ?? 'Misi desa belum ditetapkan.'); ?></p>
            </div>
        </div>
    </div>

    <h3 class="text-center fw-bold text-muted mb-4 pt-3">Data Pokok Desa</h3>
    <div class="row g-4 mb-5">
        <?php foreach ($stats as $stat): ?>
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm text-center p-3 h-100">
                    <div class="card-body">
                        <i class="fas <?php echo $stat['icon']; ?> fa-4x mb-3 <?php echo $stat['color']; ?>"></i>
                        <h5 class="card-title text-dark"><?php echo $stat['label']; ?></h5>
                        <p class="card-text fw-bold fs-4 text-primary"><?php echo $stat['value']; ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="card shadow-lg border-0 p-5 profile-card" style="background-color: white;">
        <h3 class="fw-bold text-primary mb-4"><i class="fas fa-book-open me-2"></i>Sejarah Singkat Desa <?php echo $profile['nama_desa'] ?? 'Kita'; ?></h3>
        <p class="lead text-muted fst-italic"><?php echo $profile['sejarah'] ?? 'Mohon maaf, data sejarah lengkap belum tersedia.'; ?></p>
        
        <hr class="my-4">
        
        <h4 class="fw-bold text-secondary mb-3"><i class="fas fa-location-dot me-2"></i>Kantor Pemerintah Desa</h4>
        <p class="mb-0 text-dark"><?php echo $profile['alamat'] ?? 'Alamat kantor desa belum tersedia.'; ?></p>
        <a href="#" class="btn btn-sm btn-outline-primary mt-3 align-self-start"><i class="fas fa-map me-1"></i> Lihat di Peta</a>
    </div>

</div>



<div class="container my-5 py-3" id="struktur">
    <h2 class="text-center section-title">Struktur Perangkat Desa</h2>
    
    <?php if ($struktur->num_rows > 0): ?>
    <div class="row g-4 justify-content-center">
        <?php while ($row = $struktur->fetch_assoc()): ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card h-100 shadow-sm card-perangkat">
                    <img src="assets/perangkat/perangkat<?php echo $row['foto'] ?: 'default.png'; ?>" 
                          class="card-img-top card-img-top-custom" 
                          alt="<?php echo $row['nama']; ?>"
                          loading="lazy">
                    <div class="card-body text-center card-body-custom">
                        <h5 class="card-title fw-bold" style="color: var(--bs-primary);"><?php echo $row['nama']; ?></h5>
                        <p class="card-text text-muted small mb-3"><?php echo $row['jabatan']; ?></p>
                        
                        <a href="views/frontend_view/login.php?id=<?php echo $row['id']; ?>" 
                           class="btn btn-sm btn-secondary rounded-pill mt-2">
                            <i class="fas fa-address-card me-1"></i> Lihat Biodata
                        </a>
                        </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <?php else: ?>
        <p class="alert alert-warning text-center">Data struktur perangkat desa belum tersedia.</p>
    <?php endif; ?>
</div>


<footer class="footer-custom text-white text-center py-4">
    <div class="container">
        <p class="mb-1"><i class="fas fa-code-branch me-2"></i>Pengembangan & Desain: Agymnastiar LR</p>
        <p class="mb-0">&copy; <?php echo date("Y"); ?> Pemerintah Desa <?php echo $profile['nama_desa'] ?? 'Kita'; ?>. Semua Hak Dilindungi.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="assets/js/main.js"></script>
</body>
</html>