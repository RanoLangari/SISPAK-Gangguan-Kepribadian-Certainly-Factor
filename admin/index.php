<?php

session_start();

if (!isset($_SESSION["level2"])) {
  header("Location: ../index.php");
  exit;


}

require '../functions.php'; 

$level1 = "client";
$level2 = "admin";

$jdata = count(query("SELECT * FROM tuser WHERE level = '$level1'"));
$jdata2 = count(query("SELECT * FROM tuser WHERE level = '$level2'"));

$kdata = count(query("SELECT * FROM konsultasi"));

$gdata = count(query("SELECT * FROM tgejala"));

$pdata = count(query("SELECT * FROM tpenyakit"));

$sdata = count(query("SELECT * FROM solusi"));

$adata = count(query("SELECT * FROM taturancf"));

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
    <link rel="stylesheet" href="css/admin.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->


            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item bg-gradient-primary">
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
                <a class="nav-link" href="Penyakit.php">
                    <i class="fas fa-viruses"></i>
                    <span>Gangguan</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">


            <!-- Nav Item - Penanganan -->
            <!--<li class="nav-item">
                <a class="nav-link" href="penanganan.php">
                    <i class="fas fa-hand-holding-medical"></i>
                    <span>Solusi</span></a>
            </li>-->

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

                    <h5 class="small font-weight-bold lead text-primary" style="margin-top: 10px;">SISTEM PAKAR
                        DIAGNOSIS
                        GANGGUAN KEPRIBADIAN BERDASARKAN DSM V MENGGUNAKAN METODE CERTAINTY FACTOR</h5>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow" style="margin-top: -5px;">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-primary "><?=strtolower($_SESSION['username']);?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">

                                <a class="dropdown-item text-danger font-weight-bold" href="#" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Keluar
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h5 class="h3 mb-4 text-gray-800">Selamat Datang <b
                            class="text-primary"><?=strtolower($_SESSION['username']);?></b> !</h5>
                    <hr>
                    <div class="row ml-6">
                        <div class="card">
                            <div class="card-body">
                                <p>Gangguan kepribadian, menurut Diagnostic Statistical Manual Of Mental Disorders V
                                    (DSM V), adalah sebuah pola bertahan atas pengalaman personal dan tingkah laku yang
                                    menyimpang dari ekspektasi kultur di sekitar individu, bersifat tidak fleksibel dan
                                    pervasif, memiliki onset sejak tahap remaja atau dewasa awal, cenderung stabil
                                    sepanjang waktu, dan merujuk pada distres dan gangguan.</p>
                            </div>
                        </div> <br>
                        <div class="card">
                            <div class="card-body">
                                <p>Sistem pakar / <i> expert system </i> merupakan sebuah sistem yang
                                    dibuat dan memiliki kemampuan berpikir dan bertindak layaknya seorang pakar,
                                    bertugas sebagai seorang asisten pembantu untuk menyelesaikan suatu permasalahan.
                                </p>
                            </div>
                        </div><br>
                        <div class="card">
                            <div class="card-body">
                                <p>
                                    Sistem pakar diagnosis gangguan kepribadian merupakan sebuah sistem pakar yang dibuat untuk
                                    menggantikan atau bertugas sebagai asisten pakar (psikolog) untuk membantu dalam
                                    proses mendiagnosa gangguan kepribadian pada mahasiswa atau user dengan perhitungan
                                    menggunakan metode certainty factor beserta solusi penanganannya.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- /.container-fluid -->


            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <p class="mr-4"> &copy; Copyright <strong><span>Sistem Pakar | Gangguan
                                    Kepribadian</span></strong>. All
                            Rights Reserved</p>
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

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

<script type='text/javascript'>
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
</script>

</html>