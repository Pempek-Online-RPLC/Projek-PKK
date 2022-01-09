<?php 

include('../koneksi/koneksi.php');

$id = isset($_GET['id']) ? $_GET['id'] : '';

$hapus= mysqli_query($koneksi, "DELETE FROM pemesanan WHERE id_pemesanan='$id'");

if($hapus){
    echo "<script>
alert('Data berhasil dihapus');
document.location='produk_admin.php';
</script>";
}else {
    echo "<script>
alert('Data gagal dihapus');
document.location='produk_admin.php';
</script>";
}
	

 ?>