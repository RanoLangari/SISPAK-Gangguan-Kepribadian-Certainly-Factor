<?php
session_start();

if (!isset($_SESSION["level2"])) {
    header("Location: ../index.php");
    exit;
}

require '../functions.php';

if (isset($_POST["reset"])) {
    $_SESSION["keywordk"] = "";
    header("Location:?hal=1");
}

$jdataK = count(query("SELECT * FROM konsultasi"));

//pagenation

$batas = 5000000;

if (isset($_SESSION["keywordk"])) {

    $keyword = $_SESSION["keywordk"];

    $jdata = count(query("SELECT * FROM konsultasi WHERE 
                          id_konsultasi LIKE '%$keyword%' OR
                          id_kuser LIKE '%$keyword%' OR
                          kpenyakit LIKE '%$keyword%' OR
                          persentase LIKE '%$keyword%' OR
                          id_ksolusi LIKE '%$keyword%' OR
                          kdate LIKE '%$keyword%'"));
} elseif (!isset($_SESSION["keywordk"])) {

    $jdata = count(query("SELECT * FROM konsultasi"));
}

$jhal = ceil($jdata / $batas);

// halaman aktif

$hal = (isset($_GET["hal"])) ? $_GET["hal"] : 1;

$hal_awal = ($batas * $hal) - $batas;

//limit pagination

$bts_hal = 1;

$send_num = ($hal < ($jhal - $bts_hal)) ? $hal + $bts_hal : $hal;


//akhir pagenation

//query data

if (isset($_SESSION["keywordk"])) {

    $konss = "SELECT * FROM konsultasi WHERE
              id_konsultasi LIKE '%$keyword%' OR
              id_kuser LIKE '%$keyword%' OR
              kpenyakit LIKE '%$keyword%' OR
              kusername LIKE '%$keyword%' OR
              kprodi LIKE '%$keyword%' OR
              kjenis_kelamin LIKE '%$keyword%' OR
              persentase LIKE '%$keyword%' OR
              id_ksolusi LIKE '%$keyword%' OR
              kdate LIKE '%$keyword%' ORDER BY 
              id_konsultasi DESC LIMIT $hal_awal, $batas";

    $kons = query($konss);
} elseif (!isset($_SESSION["keywordk"])) {

    $kons = query("SELECT * FROM `konsultasi` k JOIN tuser tu ON tu.id_tuser = k.id_kuser ORDER BY id_konsultasi DESC LIMIT $hal_awal, $batas");
}

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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/gejala.css">

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
            <li class="nav-item bg-gradient-primary">
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

            <!-- Nav Item - Gangguan -->
            <li class="nav-item">
                <a class="nav-link" href="penyakit.php">
                    <i class="fas fa-viruses"></i>
                    <span>Gangguan</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">


            <!-- Nav Item - Solusi -->
            <!-- <li class="nav-item">
                  <a class="nav-link" href="penanganan.php">
                    <i class="fas fa-hand-holding-medical"></i>
                    <span>Solusi</span></a>
                  </li> -->

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
                    <h5 class="small font-weight-bold lead text-primary" style="margin-top: 10px;">SISTEM PAKAR
                        DIAGNOSIS
                        GANGGUAN KEPRIBADIAN BERDASARKAN DSM V MENGGUNAKAN METODE CERTAINTY FACTOR
                    </h5>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form method="post" class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small keyword" placeholder="Cari.." aria-label="Search" aria-describedby="basic-addon2" id="keyword2" name="keyword2">
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
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-primary "><?= $_SESSION['username'] ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                                <a class="dropdown-item text-primary font-weight-bold" href="#" data-toggle="modal" data-target="#logoutModal">
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
                                <h5 class="h5 text-gray-800 pt-1"><i class="fa fa-server"></i> (<?= $jdataK; ?>) Riwayat
                                    Diagnosa</h5>
                            </div>

                            <div class="col" id="btn_reg">

                                <!-- Cetak Laporan -->

                                <a href="../kcetak.php" class="btn btn-light text-primary border border-primary rounded-pill font-weight-bold mb-1 btn-sm" style="margin-left: 300px;">Cetak <i class="fa fa-print"></i></a>

                            </div>

                        </div>
                        <hr>

                        <!-- tabel data user -->

                        <div class="row">
                            <div class="col">

                                <div class="card highlight ">
                                    <div class="card-header bg-primary text-white font-weight-bold ">
                                        Tabel Data Riwayat Diagnosa
                                    </div>
                                    <div class="card-body ">
                                        <table id="example" class="table table-bordered">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>No.</th>
                                                    <th>Tanggal</th>
                                                    <th>ID</th>
                                                    <th>Nama</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>Program Studi</th>
                                                    <th>Gangguan</th>
                                                    <th>Persentase</th>


                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                $nomor = $hal_awal + 1;

                                                foreach ($kons as $ko) :
                                                ?>

                                                    <tr>
                                                        <td class="text-center"><?= $nomor++; ?></td>
                                                        <td class="text-capitalize text-center"><?= $ko['kdate']; ?></td>
                                                        <td class="text-center font-weight-bold">
                                                            <?= $ko['id_konsultasi']; ?></td>
                                                        <td class="font-weight-bold text-capitalize text-center">
                                                            <?= $ko['nama']; ?></td>
                                                        <td class="font-weight-bold text-capitalize text-center">
                                                            <?= $ko['jenis_kelamin']; ?></td>
                                                        <td class="font-weight-bold text-capitalize text-center">
                                                            <?= $ko['prodi']; ?></td>
                                                        <td class="font-weight-bold text-capitalize text-center">
                                                            <?= $ko['kpenyakit']; ?></td>
                                                        <td class="font-weight-bold text-capitalize text-center">
                                                            <?= $ko['persentase']; ?> %</td>
                                                        <!-- <td class="font-weight-bold text-capitalize text-center"><?= $ko['id_ksolusi']; ?></td> -->

                                                    </tr>

                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
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
                                <p class="mr-4"> &copy; Copyright <strong><span>Sistem Pakar | Gangguan
                                            Kepribadian</span></strong>.
                                    All Rights Reserved</p>
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
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

        <!-- Modal Registrasi -->

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary font-weight-bold" id="exampleModalLabel"><i class="fa fa-file-medical fa-lg"></i> Tambah Gejala</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" class="font-weight-bold">

                            <div class="form-group">
                                <label for="idG" class="col-form-label">ID :</label>
                                <input class="form-control" type="text" id="idG" name="idG" readonly value="<?= $id_gejala; ?>">
                            </div>

                            <div class="form-group">
                                <label for="ngejala" class="col-form-label">Gejala :</label>
                                <input type="text" class="form-control" name="ngejala" id="ngejala" required="">
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                        <button type="submit" name="btnsimpan" class="btn btn-success">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Ubah Data Gejala -->

        <div class="modal fade" id="ubah_data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary font-weight-bold" id="exampleModalLabel"><i class="fa fa-edit fa-lg"></i> Ubah Data Gejala</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" class="font-weight-bold">

                            <div class="form-group">
                                <label for="idG" class="col-form-label">ID :</label>
                                <input class="form-control" type="text" id="uidG" name="uidG" readonly>
                            </div>

                            <div class="form-group">
                                <label for="ngejala" class="col-form-label">Gejala :</label>
                                <input type="text" class="form-control" name="ungejala" id="ungejala" required="">
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                        <button type="submit" name="btnubah" class="btn btn-success" onclick="return confirm('Anda Yakin Ingin Mengubah Data Gejala?');">Ubah</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>



</body>
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>

<script type='text/javascript'>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

</html>