<?php
session_start();
include "koneksi.php";

// Cek apakah sudah login
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Ambil statistik
$query_total_berita = "SELECT COUNT(*) as total FROM berita";
$result_total = mysqli_query($conn, $query_total_berita);
$total_berita = mysqli_fetch_assoc($result_total)['total'];

$query_total_kategori = "SELECT COUNT(*) as total FROM kategori";
$result_kategori = mysqli_query($conn, $query_total_kategori);
$total_kategori = mysqli_fetch_assoc($result_kategori)['total'];

// Ambil berita terbaru
$query_berita = "SELECT A.id_berita, B.nm_kategori, A.judul, A.pengirim, A.tanggal 
                 FROM berita A, kategori B 
                 WHERE A.id_kategori=B.id_kategori 
                 ORDER BY A.id_berita DESC";
$result_berita = mysqli_query($conn, $query_berita);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Kelola Berita</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
        }
        
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar h1 {
            font-size: 24px;
        }
        
        .navbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .navbar-right span {
            font-size: 14px;
        }
        
        .navbar-right a {
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            background: rgba(255,255,255,0.2);
            border-radius: 5px;
            transition: background 0.3s;
        }
        
        .navbar-right a:hover {
            background: rgba(255,255,255,0.3);
        }
        
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }
        
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }
        
        .stat-icon.blue {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .stat-icon.green {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }
        
        .stat-info h3 {
            font-size: 32px;
            color: #333;
            margin-bottom: 5px;
        }
        
        .stat-info p {
            color: #666;
            font-size: 14px;
        }
        
        .content-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .content-header {
            padding: 20px 25px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .content-header h2 {
            color: #333;
            font-size: 20px;
        }
        
        .btn {
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            transition: transform 0.2s;
            display: inline-block;
        }
        
        .btn:hover {
            transform: translateY(-2px);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .btn-success {
            background: #28a745;
            color: white;
        }
        
        .btn-danger {
            background: #dc3545;
            color: white;
        }
        
        .btn-warning {
            background: #ffc107;
            color: #333;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        
        th {
            background: #f8f9fa;
            color: #333;
            font-weight: 600;
        }
        
        tr:hover {
            background: #f8f9fa;
        }
        
        .action-buttons {
            display: flex;
            gap: 5px;
        }
        
        .action-buttons a {
            padding: 6px 12px;
            font-size: 12px;
        }
        
        .menu-links {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }
        
        .menu-links a {
            padding: 10px 20px;
            background: white;
            color: #667eea;
            text-decoration: none;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: all 0.3s;
        }
        
        .menu-links a:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>📰 Dashboard Berita</h1>
        <div class="navbar-right">
            <span>Selamat datang, <strong><?php echo $_SESSION['nama']; ?></strong></span>
            <a href="logout.php">Logout</a>
        </div>
    </div>
    
    <div class="container">
        <div class="menu-links">
            <a href="index.php" target="_blank">🏠 Lihat Website</a>
            <a href="input_berita.php">➕ Tambah Berita</a>
            <a href="arsip_berita.php">📁 Arsip Berita</a>
        </div>
        
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon blue">📰</div>
                <div class="stat-info">
                    <h3><?php echo $total_berita; ?></h3>
                    <p>Total Berita</p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon green">📂</div>
                <div class="stat-info">
                    <h3><?php echo $total_kategori; ?></h3>
                    <p>Total Kategori</p>
                </div>
            </div>
        </div>
        
        <div class="content-card">
            <div class="content-header">
                <h2>Daftar Berita</h2>
                <a href="input_berita.php" class="btn btn-primary">+ Tambah Berita</a>
            </div>
            
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Pengirim</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    while($row = mysqli_fetch_assoc($result_berita)): 
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo stripslashes($row['judul']); ?></td>
                        <td><?php echo stripslashes($row['nm_kategori']); ?></td>
                        <td><?php echo stripslashes($row['pengirim']); ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($row['tanggal'])); ?></td>
                        <td>
                            <div class="action-buttons">
                                <a href="berita_lengkap.php?id=<?php echo $row['id_berita']; ?>" class="btn btn-primary" target="_blank">Lihat</a>
                                <a href="edit_berita.php?id=<?php echo $row['id_berita']; ?>" class="btn btn-warning">Edit</a>
                                <a href="delete_berita.php?id=<?php echo $row['id_berita']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus berita ini?')">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
