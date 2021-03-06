<?php

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: ../../login/login_admin.php");
    exit;
}

require '../koneksi.php';

//ambil data di url
$id_user=$_GET["id"];
var_dump($id_user);
//query data berdasarkan id
$kt = query("SELECT * FROM user WHERE id_user=$id_user")[0];


//cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ) {

  //cek apakah data berhasil diubah atau tidak
  if (ubah_user ($_POST) > 0 ) {
    echo "
      <script>
        alert('Selamat, Data Anda telah Tersimpan :) ');
        document.location.href = '';
      </script>  
    ";
  } else {
    echo "

    ";
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
              <a class="nav-link" href="index_admin.php">
                <span class="menu-title">Beranda</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="data_dokter.php">
                <span class="menu-title">Data Dokter</span>
                <i class="mdi mdi mdi-account-circle menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="data_pasien.php">
                <span class="menu-title">Data Pasien</span>
                <i class="mdi mdi-account-box menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="riwayat_diagnosa.php">
                <span class="menu-title">Riwayat Diagnosa</span>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
            <?php foreach($kt as $row) : ?><?php endforeach; ?>
              <a class="nav-link" href="edit_profil_admin.php?id=<?= $_SESSION["id_user"];?>">
                <span class="menu-title">Profil</span>
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
                <span class="page-title-icon bg-gradient-danger text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard
              </h3>
            </div>
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body text-center">
                    <h4 class="card-title">Profil Anda</h4>
                    <hr><br><br>

                    <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_user" value="<?= $kt["id_user"]; ?>">
                    <input type="hidden" name="password" value="<?= $kt["password"]; ?>">
                    <input type="hidden" name="role" value="<?= $kt["role"]; ?>">
                    
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="nama">Nama : </label>
                            <input type="text" name="nama" id="nama" class="form-control" autocomplete="off" required value="<?= $kt["nama"];?>" >
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="username">Username :</label>
                            <input type="text" name="username" id="username" class="form-control" autocomplete="off" required value="<?= $kt["username"];?>" >
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="email">Email :</label>
                            <input type="text" name="email" id="email" class="form-control" autocomplete="off" required value="<?= $kt["email"];?>">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="username">Jenis Kelamin :</label>
                            <input type="text" name="jk" id="jk" class="form-control" autocomplete="off" required value="<?= $kt["jk"];?>" >
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="usia">Tanggal Lahir :</label>
                            <input type="date" name="usia" id="usia" class="form-control" autocomplete="off" required >
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="password">Password :</label>
                            <input type="password" name="password" id="password" class="form-control" autocomplete="off" required placeholder="Masukkan Password"> 
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="password2"> Masukkan Kembali Password :</label>
                            <input type="password" name="password2" id="password2" class="form-control" autocomplete="off" required placeholder="Masukkan Kembali Password"> 
                          </div>
                        </div>
                      </div>
                      <button type="submit" name="submit" class="btn btn-info">Ubah Profil</button>
                    </form>
              
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
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