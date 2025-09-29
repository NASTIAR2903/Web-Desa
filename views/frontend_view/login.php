<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Desa Digital</title>
    
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

        
        .form-login {
            width: 100%;
            max-width: 400px; 
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
    </style>
</head>
<body>

<div class="form-login">
    <div class="card shadow-lg border-0 rounded-3 card-with-back-button">
        
        <a href="../../index.php" class="btn btn-sm btn-outline-secondary back-button rounded-pill">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>

        <div class="card-header-custom py-4 text-center">
            <i class="fas fa-sign-in-alt fa-3x mb-2"></i>
            <h4 class="mb-0 fw-bold">Masuk ke Akun Anda</h4>
        </div>
        
        <div class="card-body p-4">
            
            <form action="../../controllers/authentication/login_store.php" method="POST">
                
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="name@example.com">
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label fw-bold">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <button type="submit" class="w-100 btn btn-lg btn-secondary fw-bold">
                    <i class="fas fa-unlock-alt me-1"></i> Login
                </button>
            </form>
            
            <hr class="my-4">
            
            <p class="text-center text-muted">
                Belum punya akun? <a href="register.php" class="text-primary fw-bold text-decoration-none">Daftar di sini</a>
            </p>
        </div>
    </div>
    
    <p class="mt-4 mb-3 text-muted text-center small">&copy; <?php echo date("Y"); ?> Pemerintah Desa</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>