<?php
if(isset($_POST['tambah'])){
include('../koneksi/koneksi.php'); 
    $nama = $_POST['nama_menu'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $nama_file = $_FILES['gambar']['name'];
    $source = $_FILES['gambar']['tmp_name'];
    $folder = '../gambar/';

    move_uploaded_file($source, $folder.$nama_file);
    $insert = mysqli_query($koneksi, "INSERT INTO produk VALUES (NULL,'$nama','$stok', '$harga', '$nama_file')");

    if($insert){
      echo "<script>
				alert('Produk Berhasil Ditambahkan !');
				document.location='produk_admin.php';
		  </script>";
    }
    else {
      echo "Maaf, terjadi kesalahan saat mencoba menyimpan data ke database";
    }
  }

   ?>