<?php
include "koneksi.php";
if (isset($_GET['id'])){
	$id_berita = $_GET['id'];
	} else {
	die (" Error. No Id Selected! ");
	}
?>
<html>
<head><title>Delete Berita</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
		<a href="index.php">Halaman Depan</a> |
		<a href="arsip_berita.php">Arsip Berita</a> |
		<a href="input_berita.php">Input Berita</a>
		<br><br>
		<?php
		//proses delete berita
		if (!empty($id_berita)) {
		$query = "DELETE FROM berita WHERE id_berita=$id_berita";
		$sql = mysqli_query ($conn, $query);
		if ($sql){
		echo "<h2><font colour=blue>Berita telah berhasil dihapus</font></h2>";
		} else {
		echo "<h2><font colour=red>Berita gagal dihapus</font></h2>";
		}
		echo "klik <a href='arsip_berita.php'>disini</a> untuk kembali kehalaman arsip berita";
		} else {
			die ("Access Denied");
		}
		?>
	</body>
</html>
