<?php 
session_start();

if (!isset($_SESSION["level2"])) {
  header("Location: ../index.php");
  exit;
}

require '../functions.php';

if (isset($_POST["reset"])) {

    $_SESSION["keywords"]="";

    header("Location:?hal=1");

}

$jdataS = count(query("SELECT * FROM solusi"));

//pagenation

$batas = 5;

if (isset($_SESSION["keywords"])) {

    $keyword = $_SESSION["keywords"];
    
    $jdata = count(query("SELECT * FROM solusi WHERE 
                          id_solusi LIKE '%$keyword%' OR
                          des_solusi LIKE '%$keyword%' OR
                          n_spenyakit LIKE '%$keyword%'"));

}elseif(!isset($_SESSION["keywords"])){

$jdata = count(query("SELECT * FROM solusi"));

}

$jhal = ceil($jdata / $batas);

// ternari (halaman aktif)

$hal = (isset($_GET["hal"]) ) ? $_GET["hal"] : 1;

$hal_awal = ($batas * $hal) - $batas;  

//limit pagination

$bts_hal = 1;

$send_num = ($hal < ($jhal - $bts_hal))? $hal + $bts_hal : $hal; 


//akhir pagenation

//query data

if (isset($_SESSION["keywords"])) {
  
  $solusii = "SELECT * FROM solusi WHERE
                id_solusi LIKE '%$keyword%' OR
                des_solusi LIKE '%$keyword%' OR
                n_spenyakit LIKE '%$keyword%' ORDER BY 
                id_solusi DESC LIMIT $hal_awal,$batas";

  $solusi = query($solusii);

}elseif(!isset($_SESSION["keywords"])){

$solusi = query("SELECT * FROM solusi ORDER BY id_solusi DESC LIMIT $hal_awal, $batas");

}

//query data penyakit

$penyakit = query("SELECT * FROM tpenyakit");


//tambah penanganan

if (isset($_POST["btnsimpan"]) ) {


  if (simpanS($_POST) > 0) {

    echo "
    <script>
    alert('Data solusi berhasil disimpan!');
    document.location = 'penanganan.php';
    </script>
    ";
  }
  else{
    echo "<script>
    alert('Data solusi gagal disimpan!');
    document.location = 'penanganan.php';
    </script>
    ";
  }

}

//akhir tambah penanganan


//ubah data penanganan

if (isset($_POST["btnubah"])) {

  if (ubahS($_POST) > 0) {

    echo "
    <script>
    alert('Data solusi berhasil diubah!');    
    document.location = 'penanganan.php';
    </script>
    ";


  } else{

    echo "<script>
    alert('Data solusi gagal diubah!');
    document.location = 'penanganan.php';
    </script>
    ";
  }


}


// id penanganan

$query = "SELECT max(id_solusi) as max_code FROM solusi";

$hasil = mysqli_query($conn, $query);

$data = mysqli_fetch_assoc($hasil);

$id = $data['max_code'];

$urutan = (int)substr($id, 1,3);

$urutan++;

$huruf = 'S';

$id_solusi = $huruf. sprintf("%02s",$urutan);

// akhir id penanganan

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Gangguan Kepribadian | Admin</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
  href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
  rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <link rel="stylesheet"  href="css/gejala.css">

</head>

<body id="page-top">


  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->

    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Konsultasi -->
        <li class="nav-item">
          <a class="nav-link" href="konsultasi.php">
            <i class="fas fa-history"></i>
            <span>Riwayat Diagnosa</span></a>
          </li>

          <!-- Divider -->
          <hr class="sidebar-divider my-0">

          <!-- Nav Item - User -->
          <li class="nav-item">
            <a class="nav-link" href="users.php">
              <i class="fas fa-users"></i>
              <span>User</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">


            <!-- Nav Item - Gejala -->
            <li class="nav-item">
              <a class="nav-link" href="gejala.php">
                <i class="fas fa-stethoscope"></i>
                <span>Gejala</span></a>
              </li>


              <!-- Divider -->
              <hr class="sidebar-divider my-0">


              <!-- Nav Item - Penyakit -->
              <li class="nav-item">
                <a class="nav-link" href="penyakit.php">
                  <i class="fas fa-viruses"></i>
                  <span>Gangguan</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">


                <!-- Nav Item - Penanganan -->
                <li class="nav-item bg-gradient-danger">
                  <a class="nav-link" href="penanganan.php">
                    <i class="fas fa-hand-holding-medical"></i>
                    <span>Solusi</span></a>
                  </li>

                  <!-- Divider -->
                  <hr class="sidebar-divider my-0">


                  <!-- Nav Item - Aturan -->
                  <li class="nav-item">
                    <a class="nav-link" href="aturan.php">
                      <i class="fas fa-cog"></i>
                      <span>Aturan</span></a>
                    </li>

                      <!-- Divider -->
                      <hr class="sidebar-divider">

                      <!-- Sidebar Toggler (Sidebar) -->
                      <div class="text-center d-none d-md-inline">
                        <button class="rounded-circle border-0" id="sidebarToggle"></button>
                      </div>

                    </ul>      
                    <!-- End of Sidebar -->

                    <!-- Content Wrapper -->
                    <div id="content-wrapper" class="d-flex flex-column">

                      <!-- Main Content -->
                      <div id="content">

                        <!-- Topbar -->
                        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                          <!-- Sidebar Toggle (Topbar) -->
                          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                          </button>

                          <!-- Topbar Search -->
                          <form method="post" 
                          class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                          <div class="input-group">

                            <input type="text" class="form-control bg-light border-0 small" placeholder="Cari..."
                            aria-label="Search" aria-describedby="basic-addon2" id="keywords" name="keywords" autocomplete="off" autofocus="">                           

                            <div class="input-group-append">
                              <button class="btn btn-danger" id="reset" name="reset" type="submit">
                                <i class="fas fa-sync-alt fa-sm"></i>
                              </button>
                            </div>
                          </div>
                        </form>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                          <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                          <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                          </a>
                          <!-- Dropdown - Messages -->
                          <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                          aria-labelledby="searchDropdown">
                          <form method="post" class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                              <input type="text" class="form-control bg-light border-0 small keyword" id="keywords2"
                              placeholder="Cari.." aria-label="Search"
                              aria-describedby="basic-addon2"
                              name="keywords2">

                              <div class="input-group-append">
                                <button name="reset" class="btn btn-primary" type="submit">
                                  <i class="fas fa-sync-alt fa-sm"></i>
                                </button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </li>



                      <div class="topbar-divider d-none d-sm-block"></div>

                      <!-- Nav Item - User Information -->
                      <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-danger "><?=$_SESSION['username']?></span>
                        <img class="img-profile rounded-circle"
                        src="img/undraw_profile.svg">
                      </a>
                      <!-- Dropdown - User Information -->
                      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                      aria-labelledby="userDropdown">
                      
                      <a class="dropdown-item text-danger font-weight-bold" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
                        Keluar
                      </a>
                    </div>
                  </li>

                </ul>

              </nav>
              <!-- End of Topbar -->


              <!-- Begin Page Content -->
              <section>

                <div class="container-fluid ">
                  
                  <div class="row" id="row-info-user">
                    
                    <div class="col">

                      <!-- Page Heading -->
                      <h5 class="h5 text-gray-800 pt-1"><i class="fa fa-hand-holding-medical"></i> (<?= $jdataS;?>) Solusi</h5>

                    </div>

                    <div class="col" id="btn_reg">

                    <!-- register admin -->

                    <button class="btn btn-light text-danger mb-1 font-weight-bold btn-sm border border-danger rounded-pill" style="margin-left: 200px;" data-toggle="modal" data-target="#exampleModal" type="button" id="btn-admin">Tambah Solusi <i class="fa fa-file-medical"></i></button>

                    <a href="../scetak.php" class="btn btn-light text-danger border border-danger rounded-pill font-weight-bold mb-1 btn-sm">Cetak <i class="fa fa-print"></i></a>
                                      
                    </div>

                  </div>
                  <hr>

                  <!-- tabel data user -->

                  <div class="row">
                    <div class="col" >

                     <div class="card highlight ">
                      <div class="card-header bg-danger text-white font-weight-bold ">
                        Tabel Data Solusi
                      </div>
                      <div class="card-body ">                                                              
                        <div class="table-responsive">
                          <div id="cari">

                           <?php if(isset($_SESSION["keywords"])): ?>
                            <?php if ($keyword != "" ): ?>

                            <p id="jhp">Terdapat <?= $jdata;?> hasil pencarian untuk <i class="text-info"><?= $keyword;?></i></p>

                            <?php endif; ?>
                          <?php endif; ?>

                           <table class="table table-hover table-bordered table-striped"  style="color: black;">
                             <tr class="text-center">
                              <th>No.</th>
                              <th>ID</th>
                              <th>Solusi</th>
                              <th>Gangguan</th>                          
                              <th>Aksi</th>         
                             
                            </tr>

                            <?php 
                            $nomor = $hal_awal+1;

                            foreach ($solusi as $sol): 
                              ?>

                              <tr>
                               <td class="text-center col-md-1"><?=$nomor++;?></td>
                               <td class="text-center"><?=$sol['id_solusi'];?></td>
                               <td class="text-left col-md-5"><?=$sol['des_solusi'];?></td>
                               <td class="font-weight-bold text-capitalize"><?=$sol['n_spenyakit'];?></td>                        
                               <td class="text-center"><a id="ubahs" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ubah_data" data-id="<?=$sol['id_solusi'];?>" data-dessolusi="<?=$sol['des_solusi'];?>" data-spenyakit="<?= $sol['n_spenyakit'];?>" ><i class="fa fa-edit"></i> edit</a></td>
                             </tr>   


                           <?php endforeach; ?>


                         </table>

                         <!-- pagination -->
                         <?php if ($jdata > $batas): ?>

                         <nav>
                          <ul class="pagination">

                            <?php if ($hal > 1): ?>
                              
                              <li class="page-item"><a class="page-link font-weight-bold" href="?hal=1">First</a></li>

                              <li class="page-item"><a class="page-link font-weight-bold" href="?hal=<?= $hal-1 ?>"><i class="fa fa-caret-left"></i></a></li>

                            <?php endif ?>

                            <?php for($i=1; $i <= $send_num; $i++) : ?>

                              <?php if ($i == $hal): ?>

                               <li class="page-item"><a class="page-link text-danger font-weight-bold" href="?hal=<?= $i; ?>"><?= $i;  ?></a></li>

                               <?php else: ?>

                                <li class="page-item"><a class="page-link font-weight-bold" href="?hal=<?= $i; ?>"><?= $i;  ?></a></li>

                              <?php endif; ?>               


                            <?php endfor; ?>

                            <?php if ($hal < $jhal): ?>

                              <li class="page-item"><a class="page-link font-weight-bold" href="?hal=<?= $hal + 1 ?>"><i class="fa fa-caret-right"></i></a></li>

                              <li class="page-item"><a class="page-link font-weight-bold" href="?hal=<?= $jhal;?>">Last</a></li>

                            <?php endif ?>

                          </ul>
                        </nav>

                      <?php endif; ?>

                      </div>

                    </div>



                  </div>
                </div>


              </div>
            </div>

            <!-- /.container-fluid -->

          </div>
          <!-- End of Main Content -->

          <!-- Footer -->

          <footer class="sticky-footer bg-white">
            <div class="container my-auto">
              <div class="copyright text-center my-auto">
              <p class="mr-4" > &copy; Copyright <strong><span>Sistem Pakar | Gangguan
                                            Kepribadian</span></strong>. All Rights Reserved</p>
              </div>
            </div>
          </footer>
          <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

      </div>
      <!-- End of Page Wrapper -->

      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
      </a>

      <!-- Logout Modal-->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">INFO</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Anda yakin ingin keluar?</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
            <a class="btn btn-primary" href="../logout.php">Keluar</a>
          </div>
        </div>
      </div>
    </div>


    <!-- Modal tambah penanganan -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-dark font-weight-bold" id="exampleModalLabel"><i class="fa fa-file-medical fa-lg"></i> Tambah Solusi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" class="font-weight-bold">

              <div class="form-group">
              <label for="idS" class="col-form-label">ID Solusi :</label>
              <input class="form-control" type="text" id="idS" name="idS" readonly value="<?= $id_solusi;?>">
              </div>
              

              <div class="form-group">
                <label for="spenyakit">Gangguan :</label>
                <select class="form-control text-capitalize font-weight-bold" name="spenyakit" id="spenyakit" required="">
                  
                  <option class="font-italic" value="" hidden="" disabled="" selected="">----</option>

                  <?php foreach($penyakit as $pen): ?>

                  <option class="font-weight-bold text-dark"><a href="?n=<?= $pen["n_penyakit"]; ?>"><?= $pen["n_penyakit"];?></a></option>

                 <?php endforeach; ?>

                </select>
              </div>         


              <div class="form-group">
                <label for="des_penanganan" class="col-form-label">Solusi :</label>
                <textarea class="form-control pb-5" name="des_penanganan" id="des_penanganan" required=""></textarea>
              </div> 

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
              <button type="submit" name="btnsimpan" class="btn btn-danger">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>


    <!-- Modal Ubah Data penanganan -->

    <div class="modal fade" id="ubah_data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-dark font-weight-bold" id="exampleModalLabel"><i class="fa fa-edit fa-lg"></i> Ubah Data Solusi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" class="font-weight-bold">

               <div class="form-group">
              <label for="uids" class="col-form-label">ID :</label>
              <input class="form-control" type="text" id="uids" name="uids" readonly>
              </div>

              <div class="form-group">
                <label for="uspenyakit" class="col-form-label">Gangguan :</label>
                <input type="text" readonly="" class="form-control text-capitalize font-weight-bold" name="uspenyakit" id="uspenyakit" required="">
              </div>

               <div class="form-group">
                <label for="des_penanganan" class="col-form-label">Solusi :</label>
                <textarea class="form-control pb-5" name="udes_penanganan" id="udes_penanganan" required=""></textarea>
              </div>           

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
            <button type="submit" name="btnubah" class="btn btn-danger" onclick="return confirm('Anda Yakin Ingin Mengubah Data Solusi?');">Ubah</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>    
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- <script src="../js/jquery-3.6.0.min.js"></script> -->
  <script src="js/cari.js"></script>    

</body>

<script type='text/javascript'> 

  if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );          
  }

</script>

</html>