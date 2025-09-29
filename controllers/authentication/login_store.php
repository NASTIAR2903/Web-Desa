<?php
session_start();
include "../../config/db.php";

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    
    if (password_verify($password, $user['password'])) {
        
        
        if ($user['status'] !== 'approved') {
            echo "<script>
                    alert('Akun Anda belum disetujui admin. Status: {$user['status']}');
                    window.location.href='../../views/frontend_view/login.php';
                  </script>";
            exit;
        }

        
        $_SESSION['user'] = $user;

        
        if ($user['role'] === 'admin') {
            header("Location: ../../views/backend_view/dashboard.php");
        } else {
            header("Location: ../../views/frontend_view/home.php");
        }

    } else {
        echo "<script>
                alert('Password salah!');
                window.location.href='login.php';
              </script>";
    }
} else {
    echo "<script>
            alert('User tidak ditemukan!');
            window.location.href='login.php';
          </script>";
}
