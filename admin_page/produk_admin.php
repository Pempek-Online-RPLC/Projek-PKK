<?php  
include('../koneksi/koneksi.php');
    session_start();
      if(!isset($_SESSION['login_user'])) {
        header("location: login.php");
      }else{
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../css/admin_assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="../css/admin_assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Now UI Dashboard by Creative Tim</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no" name="viewport" />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />
    <!-- CSS Files -->
    <link href="../css/admin_assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../css/admin_assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
    
    <link href="../css/admin_assets/demo/demo.css" rel="stylesheet" />
    
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

  </head>

  <body class="">
    <div class="wrapper">
      <div class="sidebar" data-color="orange">
        <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
        <div class="logo">
          <a href="../home.php" class="simple-text logo-mini"> PK </a>
          <a href="../home.php" class="simple-text logo-normal"> Pempek Kaget </a>
        </div>
        <div class="sidebar-wrapper" id="sidebar-wrapper">
          <ul class="nav">
            <li class="active">
              <a href="./produk_admin.php">
                <i class="now-ui-icons design_bullet-list-67"></i>
                <p>Produk & Pesanan</p>
              </a>
            </li>
            <li class="active-pro">
              <a href="./logout.php">
                <i class="now-ui-icons arrows-1_share-66"></i>
                <p>LOG OUT</p>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="main-panel" id="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent bg-primary navbar-absolute">
          <div class="container-fluid">
            <div class="navbar-wrapper">
              <div class="navbar-toggle">
                <button type="button" class="navbar-toggler">
                  <span class="navbar-toggler-bar bar1"></span>
                  <span class="navbar-toggler-bar bar2"></span>
                  <span class="navbar-toggler-bar bar3"></span>
                </button>
              </div>
              <a class="navbar-brand" href="produk_admin.php">Produk</a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-bar navbar-kebab"></span>
              <span class="navbar-toggler-bar navbar-kebab"></span>
              <span class="navbar-toggler-bar navbar-kebab"></span>
            </button>
        </nav>
        <!-- End Navbar -->
        <div class="panel-header panel-header-sm"></div>
        <div class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Produk</h4>
                  <a href="tambah_produk.php">+ &nbsp; Tambah Produk</a>
                </div>
                <div class="card-body">
                
        <div class="row">

          <?php 

          include('../koneksi/koneksi.php');

          $query = mysqli_query($koneksi, 'SELECT * FROM produk');
          $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
            

          ?>

          <?php foreach($result as $result) : ?>

          <div class="col-md-3 mt-4">
            <div class="card border-dark shadow">
              <img src="../gambar/<?php echo $result['gambar'] ?>" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title fw-normal"><?php echo $result['nama_menu'] ?></h5>
               <label class="card-text harga"><strong>Rp. <?php echo number_format($result['harga']); ?></strong> </label><br>
                <a href="update_produk.php?id_menu=<?php echo $result['id_menu']  ?>" class="btn btn-warning btn-sm btn-block">EDIT</a>

                <a href="delete_produk.php?id_menu=<?php echo $result['id_menu']  ?>" class="btn btn-danger btn-sm btn-block text-light" onclick="return confirm('Apakah anda yakin menghapus produk ini?')">HAPUS</a>
              </div>
            </div>
          </div>
              <?php endforeach; ?>
            </div>
          </div>

          
  <!-- Akhir Menu -->
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="card card-plain">
                <div class="card-header">
                <h4 class="text-start font-weight-bold">DATA PESANAN PELANGGAN</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
       <!-- Menu -->
    <div class="container">
      <table class="table table-bordered" id="example">
        <thead class="thead-dark">
          <tr>
            <th scope="col">No.</th>
            <th scope="col">ID Pemesanan</th>
            <th scope="col">Tanggal Pesan</th>
            <th scope="col">Total Bayar</th>
            <th scope="col">Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php $nomor=1; ?>
          <?php 
            $ambil = mysqli_query($koneksi, 'SELECT * FROM pemesanan');
            $result = mysqli_fetch_all($ambil, MYSQLI_ASSOC);
          ?>
          <?php foreach($result as $result) : ?>

          <tr>
            <th scope="row"><?php echo $nomor; ?></th>
            <td><?php echo $result["id_pemesanan"]; ?></td>
            <td><?php echo $result["tanggal_pemesanan"]; ?></td>
            <td>Rp. <?php echo number_format($result["total_belanja"]); ?></td>
            <td>
              
              <a href="detail_pesanan.php?id=<?php echo $result['id_pemesanan'] ?>" class="badge badge-primary">Detail</a>
             

              <a href="clear_pesanan.php?id=<?php echo $result['id_pemesanan'] ?>" class="badge badge-danger">Hapus Data</a>
            </td>
          </tr>
          <?php $nomor++; ?>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <!-- Akhir Menu -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <footer class="footer">
          <div class="container-fluid">
            <div class="copyright" id="copyright">
              &copy;
              <script>
                document.getElementById("copyright").appendChild(document.createTextNode(new Date().getFullYear()));
              </script>
              <a href="../home.php" target="_blank">Pempek Kaget</a>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!--   Core JS Files   -->
    <script src="../css/admin_assets/js/core/jquery.min.js"></script>
    <script src="../css/admin_assets/js/core/popper.min.js"></script>
    <script src="../css/admin_assets/js/core/bootstrap.min.js"></script>
    <script src="../css/admin_assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Chart JS -->
    <script src="../css/admin_assets/js/plugins/chartjs.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="../css/admin_assets/js/plugins/bootstrap-notify.js"></script>
   
    <script src="../css/admin_assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script>
    <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
    <script src="../css/admin_assets/demo/demo.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
      $(document).ready(function() {
          $('#example').DataTable();
      } );
    </script>
    
  </body>
</html>
<?php } ?>