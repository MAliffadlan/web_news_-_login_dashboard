<?php
session_start();
include "koneksi.php";

// Jika sudah login, redirect ke dashboard
if(isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

// Proses registrasi
$error = "";
$success = "";
if(isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password2 = mysqli_real_escape_string($conn, $_POST['password2']);
    $nama = mysqli_real_escape_string($conn, trim($_POST['nama']));
    
    // Validasi
    if(empty($username) || empty($password) || empty($password2) || empty($nama)) {
        $error = "Semua field harus diisi!";
    } elseif(strlen($username) < 4) {
        $error = "Username minimal 4 karakter!";
    } elseif(strlen($password) < 4) {
        $error = "Password minimal 4 karakter!";
    } elseif($password !== $password2) {
        $error = "Password tidak cocok!";
    } else {
        // Cek username sudah ada atau belum
        $check = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
        if(mysqli_num_rows($check) > 0) {
            $error = "Username sudah digunakan!";
        } else {
            // Insert user baru
            $query = "INSERT INTO user (username, password, nama) VALUES ('$username', '$password', '$nama')";
            $result = mysqli_query($conn, $query);
            
            if($result) {
                $insert_id = mysqli_insert_id($conn);
                $success = "Registrasi berhasil! User ID: $insert_id. Silakan login.";
                
                // Debug: Cek apakah data benar-benar masuk
                $verify = mysqli_query($conn, "SELECT * FROM user WHERE id='$insert_id'");
                if(mysqli_num_rows($verify) == 0) {
                    $error = "Data tidak tersimpan! Hubungi admin.";
                    $success = "";
                }
            } else {
                $error = "Registrasi gagal: " . mysqli_error($conn);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register - Dashboard Berita</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .register-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 450px;
        }
        
        .register-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 10px;
        }
        
        .register-container > p {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }
        
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #667eea;
        }
        
        .form-group small {
            display: block;
            margin-top: 5px;
            color: #666;
            font-size: 12px;
        }
        
        .btn-register {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s;
        }
        
        .btn-register:hover {
            transform: translateY(-2px);
        }
        
        .error-message {
            background: #fee;
            color: #c33;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .success-message {
            background: #efe;
            color: #363;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        
        .back-link a {
            color: #667eea;
            text-decoration: none;
        }
        
        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Buat Akun Baru</h2>
        <p>Daftar untuk mengelola berita</p>
        
        <?php if($error): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <?php if($success): ?>
            <div class="success-message">
                <?php echo $success; ?>
                <br><a href="login.php" style="color: #363; font-weight: bold;">Klik disini untuk login →</a>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" required placeholder="Masukkan nama lengkap" value="<?php echo isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : ''; ?>">
            </div>
            
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required placeholder="Masukkan username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                <small>Minimal 4 karakter</small>
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="Masukkan password">
                <small>Minimal 4 karakter</small>
            </div>
            
            <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="password2" required placeholder="Masukkan ulang password">
            </div>
            
            <button type="submit" name="register" class="btn-register">Daftar Sekarang</button>
        </form>
        
        <div class="back-link">
            <a href="login.php">Sudah punya akun? Login disini</a>
        </div>
        
        <div class="back-link">
            <a href="index.php">← Kembali ke Halaman Utama</a>
        </div>
    </div>
</body>
</html>
