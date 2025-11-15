<?php
include "koneksi.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//
	EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; 
charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css"> 
<!-- 
body  {
	font: 100% Verdana, Arial, Helvetica, sans-serif;
	background: #666666;
	margin: 0;  
	padding: 0;
	text-align: center; 
	color: #000000;
}
.thrColAbsHdr #container { 
	position: relative; adding position: relative allows you to position the two sidebars relative to this container */
	width: 780px;  
	background: #FFFFFF;
	margin: 0 auto; 
	border: 1px solid #000000;
	text-align: left; 
} 

.thrColAbsHdr #header { 
	height: 60px; /* if you're changing the source order of the columns, you'll may want to use a height on the header so that you can give the columns a predictable top value */
	background: #DDDDDD; 
	padding: 0 10px 0 20px;  /* this padding matches the left alignment of the elements in the divs that appear beneath it. If an image is used in the #header instead of text, you may want to remove the padding. */
} 
.thrColAbsHdr #header h1 {
	margin: 0; /* zeroing the margin of the last element in the #header div will avoid margin collapse - an unexplainable space between divs. If the div has a border around it, this is not necessary as that also avoids the margin collapse */
	padding: 10px 0; /* using padding instead of margin will allow you to keep the element away from the edges of the div */
}
.thrColAbsHdr #sidebar1 {
	position: absolute;
	top: 60px;
	left: 0;
	width: 150px; /* the actual width of this div, in standards-compliant browsers, or standards mode in Internet Explorer will include the padding and border in addition to the width */
	background: #EBEBEB; /* the background color will be displayed for the length of the content in the column, but no further */
	padding: 15px 10px 15px 20px; /* padding keeps the content of the div away from the edges */
}
.thrColAbsHdr #sidebar2 {
	position: absolute;
	top: 60px;
	right: 0;
	width: 160px; /* the actual width of this div, in standards-compliant browsers, or standards mode in Internet Explorer will include the padding and border in addition to the width */
	background: #EBEBEB; /* the background color will be displayed for the length of the content in the column, but no further */
	padding: 15px 10px 15px 20px; /* padding keeps the content of the div away from the edges */
}
.thrColAbsHdr #mainContent { 
	margin: 0 200px; /* the right and left margins on this div element creates the two outer columns on the sides of the page. No matter how much content the sidebar divs contain, the column space will remain. */
	padding: 0 10px; /* remember that padding is the space inside the div box and margin is the space outside the div box */
}
.thrColAbsHdr #footer { 
	padding: 0 10px 0 20px; /* this padding matches the left alignment of the elements in the divs that appear above it. */
	background:#DDDDDD;
} 
.thrColAbsHdr #footer p {
	margin: 0; /* zeroing the margins of the first element in the footer will avoid the possibility of margin collapse - a space between divs */
	padding: 10px 0; /* padding on this element will create space, just as the the margin would have, without the margin collapse issue */
}
.fltrt { /* this class can be used to float an element right in your page. The floated element must precede the element it should be next to on the page. */
	float: right;
	margin-left: 8px;
}
.fltlft { /* this class can be used to float an element left in your page */
	float: left;
	margin-right: 8px;
}
.style1 {	color: #0000FF
}
--> 
</style><!--[if IE 5]>
<style type="text/css"> 
/* place css box model fixes for IE 5* in this conditional comment */
.thrColAbsHdr #sidebar1 { width: 180px; }
.thrColAbsHdr #sidebar2 { width: 190px; }
</style>
<![endif]--></head>

<body class="thrColAbsHdr">

<div id="container">
  <div id="header">
    <h2>HALAMAN UTAMA BERITA TERBARU</h2>
  <!-- end #header --></div>
  <div id="sidebar1">
  <h3>MENU</h3>
  <p><a href="index.php">Halaman Depan</a></p>
  <p><a href="arsip_berita.php">Arsip Berita</a></p>
  <p><a href="login.php">Login Admin</a> 
    <!-- end #sidebar1 --></p>
  </div>
  <div id="mainContent">
    <?php
		$query = "SELECT A.id_berita, B.nm_kategori, A.judul, A.headline, A.pengirim, A.tanggal FROM berita A, kategori B WHERE
		A.id_kategori=B.id_kategori ORDER BY A.id_berita DESC LIMIT 0,5";
		$sql = mysqli_query ($conn, $query);
		while ($hasil = mysqli_fetch_array($sql)){
		$id_berita = $hasil['id_berita'];
		$kategori = stripslashes ($hasil['nm_kategori']);
		$judul = stripslashes ($hasil['judul']);
		$headline = stripslashes ($hasil['headline']);
		$pengirim = stripslashes ($hasil['pengirim']);
		$tanggal = stripslashes ($hasil['tanggal']);
//tampilkan berita
		echo "<font size=4> <a href='berita_lengkap.php?id=$id_berita'> $judul </a> </font> <br>";
		echo "<p>$headline</p>";
		echo "<small>Berita dikirimkan oleh <b>$pengirim</b> pada tanggal <b>$tanggal</b> dalam kategori <b>$kategori</b></small>";
	
		echo "<hr>";
		}
		?>
        <br /><br />
    <p>&nbsp;</p>
    <p>
      <!-- end #mainContent -->
    </p>
    </div>
  <div id="footer">
    <p><span class="style1">Design by : Nasril(Aril)</span></p>
  <!-- end #footer --></div>
<!-- end #container --></div>
</body>
</html>
