<?php
  include('../koneksi/koneksi.php'); //agar index terhubung dengan database, maka koneksi sebagai penghubung harus di include
  
?>
<!DOCTYPE html>
<html>
  <head>
    <title>CRUD Produk dengan gambar - Gilacoding</title>
    <link rel="stylesheet" href="../css/admin_assets/css/crud_produk.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  </head>
  <body>
    <div class="text-end">
      <form action="produk_admin.php">
      <button type="submit" class="btn-close me-3" aria-label="Close"></button>  
      </form>
    </div>
    
    
        <h1 class="text-warning">Tambah Produk</h1>      
      <form method="POST" action="proses_tambah_produk.php" enctype="multipart/form-data" >
      <section class="base">
        <div>
          <label>Nama Menu</label>
          <input type="text" class="form-control" id="menu1" name="nama_menu">
        </div>
        <div>
          <label>Stok</label>
          <input type="text" class="form-control" id="stok1" name="stok">
        </div>
        <div>
          <label>Harga</label>
          <input type="text" class="form-control" id="harga1" name="harga">
        </div>
        <div>
          <label>Gambar</label>
          <input type="file" class="form-control-file border mb-2" id="gambar" name="gambar">
        </div>
        <div class="text-center">
        <button type="submit" class="btn btn-warning" name="tambah">Tambah</button>
        <button type="reset" class="btn btn-warning" name="reset">Reset</button>
        </div>
        </section>
      </form>
      
  </body>
</html>