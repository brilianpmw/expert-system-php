<?php

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: ../../login/login_admin.php");
    exit;
}


require '../koneksi.php';

$sql = query("SELECT*FROM bpangan");
$found = false;
$truefound= false;
if(isset($_POST['submit'])){ 
  $kode_gejala = $_POST['kode_bahan'];
  $jumlah_dipilih = count($kode_gejala);
  $or_filtered = "";
  $text_search = 'SELECT*FROM bpangan where ';
  for ($i=0; $i <$jumlah_dipilih ; $i++) { 
    $var= " \"".$kode_gejala[$i]."\"";

    if($i<$jumlah_dipilih-1){
      $or_filtered =$or_filtered."kode_bahan=".$var." or ";
    }
    if($i == $jumlah_dipilih-1){
      $or_filtered =$or_filtered."kode_bahan=".$var;
    }
  }

  // $query = "SELECT*FROM bpangan where ".$or_filtered;
  $get_data = query($text_search.$or_filtered);

  if(count($get_data) > 0){
    $found=true;
  }else{
    $truefound=true;
  }
 
}



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sistem Pakar Metabolik</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../vendor/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../vendor/assets/vendors/css/vendor.bundle.base.css">
    <!-- Layout styles -->
    <link rel="stylesheet" href="../vendor/assets/css/style.css">
    <!-- End layout styles -->
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="index.html"> <h3>SP METABOLIK</h3> </a>
          <a class="navbar-brand brand-logo-mini" href="index.html"> <h3>SPM</h3> </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="../vendor/assets/images/faces/face1.jpg" alt="image">
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black"> <?php echo $_SESSION["username"]; ?> </p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="../../login/logout.php">
                  <i class="mdi mdi-logout mr-2 text-primary"></i>Log Out </a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="../vendor/assets/images/faces-clipart/pic-3.png" alt="profile">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2"> <?php echo $_SESSION["username"]; ?> </span>
                  <span class="text-secondary text-small"> <?php echo $_SESSION["role"]; ?> </span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index_pasien.php">
                <span class="menu-title">Beranda</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="konsultasi.php">
                <span class="menu-title">Konsultasi</span>
                <i class="mdi mdi-account-search menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="riwayat_diagnosa.php">
                <span class="menu-title">Riwayat Diagnosa</span>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="edit_profil_pasien.php?id=<?= $_SESSION["id_user"];?>">
                <span class="menu-title">Lihat Profil</span>
                <i class="mdi mdi-autorenew menu-icon"></i>
              </a>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard
              </h3>
            </div>
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body text-center">
                    <h4 class="card-title">Pilih Bahan Makanan</h4>
                    <hr>
                    <form action="bahan_makanan.php" method="post">
                    <blockquote class="blockquote">
                      <?php foreach($sql as $row) : ?>
                        <div class=" text-justify">
                          <div class="form-check form-check-info">
                            <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="kode_bahan[]" value="<?=$row["kode_bahan"] ?>"> <?= $row["nama_bahan"]; ?> </label>
                          </div>
                        </div>
                      <?php endforeach; ?>
                      </blockquote>
                     
                      <button type="submit" name="submit" class="btn btn-info">Cek </button>
                    </form>

                  </div>
                </div>
              </div>
            </div>
            <?php if($found){

?>

            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body text-center">

            <?php if(!$truefound) {?>
            <table  class="table table-bordered">
                            <tr class="table-info text-center">
                            <th>No.</th>
                            <th>Kode Bahan</th>
                            <th>Nama Bahan</th>
                            <th>Kalori</th>
                            <th>Lemak</th>
                            <th>Karbohidrat</th>

                            <th>Protein</th>
                            <th >keterangan</th>
                            </tr>

                            <?php $i = 1; ?>
                            <?php foreach($get_data as $row) : ?>
                            <tr class="text-center">
                            <td><?= $i; ?></td>
                            <td><?= $row["kode_bahan"]; ?> </td>
                            <td><?= $row["nama_bahan"];?> </td>
                            <td><?= $row["kalori"]; ?> </td>
                            <td><?= $row["lemak"]; ?> </td>
                            <td><?= $row["karbohidrat"]; ?> </td>
                            <td><?= $row["protein"]; ?> </td>
                            <td style="white-space: pre-wrap;
"><?= $row["ket"]; ?> </td>

                            </tr>
                            <?php $i++; ?>
                            <?php endforeach; ?>
                        </table><br><br>
                        <?php }else{ ?>
                        <p class="text-center">data not found</p>
                        <?php } ?>

           
           

                  </div>
                </div>
              </div>
            </div>

           
           <?php }; ?> 
          </div>
          <!-- content-wrapper ends -->

                        <!-- result -->
                        
                        <!-- end result -->

          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="container-fluid clearfix">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ?? bootstrapdash.com 2020</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates </a> from Bootstrapdash.com</span>
            </div>
          </footer>

       
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../vendor/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="../vendor/assets/vendors/chart.js/Chart.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../vendor/assets/js/off-canvas.js"></script>
    <script src="../vendor/assets/js/hoverable-collapse.js"></script>
    <script src="../vendor/assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="../vendor/assets/js/dashboard.js"></script>
    <script src="../vendor/assets/js/todolist.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>