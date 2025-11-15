<!DOCTYPE html>
<html>
<head>
    <title>Setup Database</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            max-width: 600px; 
            margin: 50px auto; 
            padding: 20px;
            background: #f5f5f5;
        }
        .box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .success { color: #28a745; font-weight: bold; }
        .error { color: #dc3545; font-weight: bold; }
        .info { color: #007bff; }
        hr { margin: 20px 0; }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="box">
        <h2>Setup Database</h2>
        <?php
        $server = "localhost";
        $username = "root";
        $pass = "";
        $db = "pw2";
        
        $conn = mysqli_connect($server, $username, $pass, $db);
        
        if(!$conn) {
            echo "<p class='error'>✗ Koneksi database gagal: " . mysqli_connect_error() . "</p>";
            echo "<p>Pastikan XAMPP MySQL sudah running!</p>";
            exit();
        }
        
        echo "<p class='success'>✓ Koneksi database berhasil</p>";
        
        // Buat tabel user
        $sql = "CREATE TABLE IF NOT EXISTS `user` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `username` varchar(50) NOT NULL,
          `password` varchar(255) NOT NULL,
          `nama` varchar(100) NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1";
        
        if(mysqli_query($conn, $sql)) {
            echo "<p class='success'>✓ Tabel user berhasil dibuat</p>";
        } else {
            echo "<p class='error'>✗ Error: " . mysqli_error($conn) . "</p>";
        }
        
        // Insert admin
        $check = mysqli_query($conn, "SELECT * FROM user WHERE username='admin'");
        if(mysqli_num_rows($check) == 0) {
            $insert = "INSERT INTO user (username, password, nama) VALUES ('admin', 'admin', 'Administrator')";
            if(mysqli_query($conn, $insert)) {
                echo "<p class='success'>✓ User admin berhasil dibuat</p>";
            } else {
                echo "<p class='error'>✗ Error: " . mysqli_error($conn) . "</p>";
            }
        } else {
            echo "<p class='info'>ℹ User admin sudah ada</p>";
        }
        
        mysqli_close($conn);
        ?>
        
        <hr>
        <h3>✓ Setup Selesai!</h3>
        <p><strong>Username:</strong> admin</p>
        <p><strong>Password:</strong> admin</p>
        <a href="login.php" class="btn">Login Sekarang →</a>
    </div>
</body>
</html>
