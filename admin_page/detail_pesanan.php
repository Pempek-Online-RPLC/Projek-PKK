<?php 
    include('../koneksi/koneksi.php');
    session_start();
      if(!isset($_SESSION['login_user'])) {
        header("location: ../sinlog/login.php");
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
    <!-- CSS Just for demo purpose, don't include it in your project -->
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
          <a href="http://www.creative-tim.com" class="simple-text logo-mini"> PK </a>
          <a href="http://www.creative-tim.com" class="simple-text logo-normal"> Pempek Kaget </a>
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
                <i class="now-ui-icons arrows-1_cloud-download-93"></i>
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
              <a class="navbar-brand" href="#pablo">Produk</a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-bar navbar-kebab"></span>
              <span class="navbar-toggler-bar navbar-kebab"></span>
              <span class="navbar-toggler-bar navbar-kebab"></span>
            </button>
            
          </div>
        </nav>
        <!-- End Navbar -->
        <div class="panel-header panel-header-sm"></div>
        <div class="content">
          <div class="row">
   
            <div class="col-md-12">
              <div class="card card-plain">
                <div class="card-header">
                <h4 class="text-start font-weight-bold">DATA PESANAN PELANGGAN</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
    
     <table class="table table-bordered" id="example">
       <thead class="thead-dark">
         <tr>
           <th scope="col">No.</th>
           <th scope="col">ID Pemesanan</th>
           <th scope="col">Nama Pesanan</th>
           <th scope="col">Harga</th>
           <th scope="col">Jumlah</th>
           <th scope="col">Subharga</th>
         </tr>
       </thead>
       <tbody>
         <?php $nomor=1; ?>
         <?php $totalbelanja = 0; ?>
         <?php 
             $ambil = $koneksi->query("SELECT * FROM pemesanan_produk JOIN produk ON pemesanan_produk.id_menu=produk.id_menu 
               WHERE pemesanan_produk.id_pemesanan='$_GET[id]'");
          ?>
          <?php while ($pecah=$ambil->fetch_assoc()) { ?>
          <?php $subharga1=$pecah['harga']*$pecah['jumlah']; ?>
         <tr>
           <th scope="row"><?php echo $nomor; ?></th>
           <td><?php echo $pecah['id_pemesanan_produk']; ?></td>
           <td><?php echo $pecah['nama_menu']; ?></td>
           <td>Rp. <?php echo number_format($pecah['harga']); ?></td>
           <td><?php echo $pecah['jumlah']; ?></td>
           <td>
             Rp. <?php echo number_format($pecah['harga']*$pecah['jumlah']); ?>
           </td>
         </tr>
         <?php $nomor++; ?>
         <?php $totalbelanja+=$subharga1; ?>
         <?php } ?>
       </tbody>
        <tfoot>
         <tr>
           <th colspan="5">Total Bayar</th>
           <th>Rp. <?php echo number_format($totalbelanja) ?></th>
         </tr>
       </tfoot>
     </table><br>
     
     <form method="POST" action="">
       <a href="produk_admin.php" class="btn btn-success btn-sm">Kembali</a>
       <button class="btn btn-primary btn-sm" name="bayar">Konfirmasi Pembayaran</button>
     </form>  
     <?php 
       if(isset($_POST["bayar"]))
       {
        include('../koneksi/koneksi.php');

        $id = isset($_GET['id']) ? $_GET['id'] : '';
        
        $hapus= mysqli_query($koneksi, "DELETE FROM pemesanan WHERE id_pemesanan='$id'");
        
        if($hapus){
            echo "<script>
        alert('Pesanan Telah Dibayar !');
        document.location='produk_admin.php';
        </script>";
        }else {
            echo "<script>
        alert('Gagal meengonfirmasi pembayaran !');
        document.location='produk_admin.php';
        </script>";
        }
      
       }
     ?>
    
   </div>
 <!-- Akhir Menu -->
    </div>
          </div>
          </div>
          </div>
          </div>
          </div>
          </div>
          </div>
  <!-- Akhir Menu -->
 
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
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
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