<?php 
include('../koneksi/koneksi.php');

$id_menu = $_POST['id_menu'];
$nama_menu = $_POST['nama_menu'];
$stok = $_POST['stok'];
$harga = $_POST['harga'];
$nama_file = $_FILES['gambar']['name'];
$source = $_FILES['gambar']['tmp_name'];
$folder = '../gambar/';

move_uploaded_file($source, $folder.$nama_file);
$edit = mysqli_query($koneksi, "UPDATE produk SET nama_menu='$nama_menu', stok='$stok', harga='$harga', gambar='$nama_file' WHERE id_menu='$id_menu' ");

if($edit)
	header('location: produk_admin.php');
else
	echo "Edit Menu Gagal";


 ?>