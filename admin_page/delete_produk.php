<?php 

include('../koneksi/koneksi.php');

$id_menu = $_GET['id_menu'];

$hapus= mysqli_query($koneksi, "DELETE FROM produk WHERE id_menu='$id_menu'");

if($hapus)
	header('location: produk_admin.php');
else
	echo "Hapus data gagal";

 ?>