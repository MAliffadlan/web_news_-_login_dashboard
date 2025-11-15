<?php
include "koneksi.php";

echo "<h2>Debug Database User</h2>";
echo "<hr>";

// Cek koneksi
if($conn) {
    echo "<p style='color: green;'>✓ Koneksi database berhasil</p>";
} else {
    echo "<p style='color: red;'>✗ Koneksi database gagal</p>";
    exit();
}

// Cek database
$db_check = mysqli_query($conn, "SELECT DATABASE()");
$current_db = mysqli_fetch_row($db_check)[0];
echo "<p><strong>Database aktif:</strong> $current_db</p>";

// Cek tabel user ada atau tidak
$table_check = mysqli_query($conn, "SHOW TABLES LIKE 'user'");
if(mysqli_num_rows($table_check) > 0) {
    echo "<p style='color: green;'>✓ Tabel 'user' ditemukan</p>";
} else {
    echo "<p style='color: red;'>✗ Tabel 'user' tidak ditemukan!</p>";
    echo "<p>Jalankan setup_database.php untuk membuat tabel user</p>";
    exit();
}

// Tampilkan semua data user
echo "<h3>Data User di Database:</h3>";
$query = "SELECT * FROM user";
$result = mysqli_query($conn, $query);

if($result) {
    $count = mysqli_num_rows($result);
    echo "<p><strong>Total user:</strong> $count</p>";
    
    if($count > 0) {
        echo "<table border='1' cellpadding='10' style='border-collapse: collapse;'>";
        echo "<tr style='background: #f0f0f0;'>";
        echo "<th>ID</th><th>Username</th><th>Password</th><th>Nama</th>";
        echo "</tr>";
        
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['password'] . "</td>";
            echo "<td>" . $row['nama'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='color: orange;'>⚠ Tidak ada user di database</p>";
    }
} else {
    echo "<p style='color: red;'>✗ Error query: " . mysqli_error($conn) . "</p>";
}

echo "<hr>";
echo "<p><a href='register.php'>Ke Halaman Register</a> | <a href='login.php'>Ke Halaman Login</a></p>";
?>
