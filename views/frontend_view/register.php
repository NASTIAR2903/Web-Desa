<?php
include "../../config/db.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Warga - Desa Digital</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="../../assets/css/style.css"> 
    
    <style>
        
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 40px; 
            padding-bottom: 40px;
            background-color: var(--bs-light) !important;
        }

        
        .form-register {
            width: 100%;
            
            max-width: 600px; 
            padding: 15px;
            margin: auto;
        }
        
        
        .card-header-custom {
            background-color: var(--bs-primary);
            color: white;
            border-bottom: none;
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
        }

        
        .card-with-back-button {
            position: relative;
        }
        .back-button {
            position: absolute;
            top: 15px;
            left: 15px;
            z-index: 10;
        }

        
        @media (max-height: 800px) {
            body {
                padding-top: 10px; 
                padding-bottom: 10px;
                align-items: flex-start;
            }
            .form-register {
                padding: 15px; 
            }
        }
        
        
        @media (max-height: 700px) {
             .card-body-scrollable {
                max-height: calc(100vh - 180px); 
                overflow-y: auto;
                padding-right: 20px !important;
            }
        }
    </style>
</head>
<body>

<div class="form-register">
    <div class="card shadow-lg border-0 rounded-3 card-with-back-button">
        
        <a href="../../index.php" class="btn btn-sm btn-outline-secondary back-button rounded-pill">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>

        <div class="card-header-custom py-4 text-center">
            <i class="fas fa-user-plus fa-3x mb-2"></i>
            <h4 class="mb-0 fw-bold">Pendaftaran Akun Warga Desa</h4>
        </div>
        
        <div class="card-body p-4 card-body-scrollable">
            
            <form action="../../controllers/authentication/register_store.php" method="POST">
                
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-primary mb-3"><i class="fas fa-lock me-1"></i> Data Akun</h6>

                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Nama Lengkap *</label>
                            <input type="text" class="form-control" id="name" name="name" required placeholder="Nama sesuai KTP">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email *</label>
                            <input type="email" class="form-control" id="email" name="email" required placeholder="name@example.com">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Password *</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    
                    <div class="col-md-6 border-start ps-md-4">
                         <h6 class="text-secondary mb-3"><i class="fas fa-id-card-alt me-1"></i> Data Pribadi</h6>

                        <div class="mb-3">
                            <label for="nik" class="form-label fw-bold">NIK *</label>
                            <input type="text" class="form-control" id="nik" name="nik" required placeholder="16 digit NIK">
                            <div class="form-text text-danger">Diperlukan untuk verifikasi.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Jenis Kelamin *</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki" value="L" required>
                                    <label class="form-check-label" for="laki">
                                        Laki-laki
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="P" required>
                                    <label class="form-check-label" for="perempuan">
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                        </div>

                        
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label fw-bold">Tanggal Lahir *</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="pekerjaan" class="form-label fw-bold">Pekerjaan</label>
                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Wiraswasta/PNS/lainnya">
                        </div>
                    </div>
                </div>
                
                <hr class="my-4">

                <button type="submit" class="w-100 btn btn-lg btn-secondary fw-bold">
                    <i class="fas fa-check-circle me-1"></i> Daftarkan Akun Saya
                </button>
            </form>
            
            <p class="text-center text-muted mt-3">
                Sudah punya akun? <a href="login.php" class="text-primary fw-bold text-decoration-none">Login di sini</a>
            </p>
        </div>
    </div>
    
    <p class="mt-4 mb-3 text-muted text-center small">&copy; <?php echo date("Y"); ?> Pemerintah Desa</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>