<?php
session_start();

if (!isset($_SESSION["level2"])) {
    header("Location: ../index.php");
    exit;
}


require '../functions.php';


if (isset($_POST["reset"])) {

    $_SESSION["keyword"] = "";

    header("Location:?hal=1");
}


$level = "client";
$level2 = "admin";

$jdataA = count(query("SELECT * FROM tuser WHERE level = '$level2'"));
$jdataC = count(query("SELECT * FROM tuser WHERE level = '$level'"));
$jdataU = count(query("SELECT * FROM tuser"));

//pagenation

$batas = 500000;

if (isset($_SESSION["keyword"])) {

    $keyword = $_SESSION["keyword"];


    $jdata = count(query("SELECT * FROM tuser WHERE 
                    id_tuser LIKE '%$keyword%' OR
                  nama LIKE '%$keyword%' OR
                  username LIKE '%$keyword%' OR
                  alamat LIKE '%$keyword%' OR
                  hp LIKE '%$keyword%' OR
                  level LIKE '%$keyword%'"));
} elseif (!isset($_SESSION["keyword"])) {

    $jdata = count(query("SELECT * FROM tuser"));
}


$jhal = ceil($jdata / $batas);


// ternari (halaman aktif)

$hal = (isset($_GET["hal"])) ? $_GET["hal"] : 1;

$hal_awal = ($batas * $hal) - $batas;


//limit pagination

$bts_hal = 1;

$send_num = ($hal < ($jhal - $bts_hal)) ? $hal + $bts_hal : $hal;


//akhir pagenation

//query data

if (isset($_SESSION["keyword"])) {

    $userss = "SELECT * FROM tuser WHERE
  id_tuser LIKE '%$keyword%' OR
  nama LIKE '%$keyword%' OR
  username LIKE '%$keyword%' OR
  alamat LIKE '%$keyword%' OR
  hp LIKE '%$keyword%' OR
  level LIKE '%$keyword%' ORDER BY id_tuser DESC LIMIT $hal_awal,$batas";

    $users = query($userss);
} elseif (!isset($_SESSION["keyword"])) {

    $users = query("SELECT * FROM tuser ORDER BY id_tuser DESC LIMIT $hal_awal, $batas");
}


//Registrasi Akun

if (isset($_POST["btndaftar"])) {

    //masukan data registrasi kedalam variabel

    if (registrasi($_POST) > 0) {

        echo "
    <script>
    alert('Registrasi Akun Berhasil!');
    document.location = 'users.php';
    </script>
    ";
    } else {
        echo "<script>
    alert('Registrasi Akun Gagal!');
    document.location = 'users.php';
    </script>
    ";
    }
}

//akhir registrasi akun


//ubah data

$id_ubah = $_SESSION["id"];
$pas = $_SESSION["pas"];

$d_ubah = query("SELECT * FROM tuser WHERE id_tuser = '$id_ubah'")[0];




if (isset($_POST["btnubah"])) {

    if (ubah($_POST) > 0) {

        echo "
    <script>
    alert('Ubah Data Akun Berhasil!');
    alert('Silakan Login Kembali!');
    document.location = '../logout.php';
    </script>
    ";
    } else {

        echo "<script>
    alert('Ubah Data Akun Gagal!');
    document.location = 'users.php';
    </script>
    ";
    }
}


// id user

$query = "SELECT max(id_tuser) as max_code FROM tuser";

$hasil = mysqli_query($conn, $query);

$data = mysqli_fetch_assoc($hasil);

$id = $data['max_code'];

$urutan = (int)substr($id, 1, 3);

$urutan++;

$huruf = 'U';

$id_user = $huruf . sprintf("%02s", $urutan);

// akhir id user





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
            <li class="nav-item">
                <a class="nav-link" href="konsultasi.php">
                    <i class="fas fa-history"></i>
                    <span>Riwayat Diagnosa</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - User -->
            <li class="nav-item bg-gradient-primary">
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
                                <h5 class="h4 text-gray-800"><?= $jdataU; ?> User</h5>

                                <p class="small font-weight-bold"><i class="fa fa-user"></i> <?= $jdataC; ?> Pasien<i class="fa fa-user ml-2"></i> <?= $jdataA; ?> Admin</p>

                            </div>

                            <div class="col" id="btn_reg">



                                <!-- register admin -->

                                <button class="btn btn-light text-primary mb-1 font-weight-bold btn-sm border border-primary rounded-pill" style="margin-left: 120px;" data-toggle="modal" data-target="#exampleModal" type="button" id="btn-admin">Registrasi Admin <i class="fa fa-user-plus"></i></button>

                                <button class="btn btn-light text-primary border border-primary rounded-pill font-weight-bold mb-1 btn-sm" data-toggle="modal" data-target="#ubah_data" type="button" id="btn-admin">Edit Akun
                                    <i class="fa fa-user-edit"></i></button>

                            </div>

                        </div>
                        <hr>

                        <!-- tabel data user -->

                        <div class="row">
                            <div class="col">

                                <div class="card highlight ">
                                    <div class="card-header bg-primary text-white font-weight-bold ">
                                        Tabel Data User
                                    </div>
                                    <div class="card-body ">
                                        <div class="table-responsive">
                                            <div id="cari">

                                                <?php if (isset($_SESSION["keyword"])) : ?>
                                                    <?php if ($keyword != "") : ?>

                                                        <p id="jhp">Terdapat <?= $jdata; ?> hasil pencarian untuk <i class="text-info"><?= $keyword; ?></i></p>

                                                    <?php endif; ?>
                                                <?php endif; ?>

                                                <table class="table" id="example">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th>No.</th>
                                                            <th>ID</th>
                                                            <th>Username</th>
                                                            <th>Nama</th>
                                                            <th>Jenis Kelamin</th>
                                                            <th>Program Studi</th>
                                                            <th>Alamat</th>
                                                            <th>Kontak</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $nomor = $hal_awal + 1;

                                                        foreach ($users as $user) :
                                                        ?>
                                                            <?php if ($user['level'] != 'admin') : ?>
                                                                <tr>
                                                                    <td class="text-center"><?= $nomor++; ?></td>
                                                                    <td class="text-center"><?= $user['id_tuser']; ?></td>
                                                                    <td class="font-weight-bold"><?= $user['username']; ?></td>
                                                                    <td><?= $user['nama']; ?></td>
                                                                    <td><?= $user['jenis_kelamin']; ?></td>
                                                                    <td><?= $user['prodi']; ?></td>
                                                                    <td><?= $user['alamat']; ?></td>
                                                                    <td><?= $user['hp']; ?></td>
                                                                    <td class="text-center"><?= $user['level']; ?></td>

                                                                </tr>

                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </tbody>


                                                </table>
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
                        <h5 class="modal-title text-dark font-weight-bold" id="exampleModalLabel"><i class="fa fa-id-card fa-lg"></i> Registrasi Admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" class="font-weight-bold">

                            <input type="text" name="iduser" value="<?= $id_user; ?>" style="display: none;">

                            <div class="form-group">
                                <label for="Ausername" class="col-form-label">Username :</label>
                                <input type="text" class="form-control" name="pusername" id="Ausername" required="">
                            </div>
                            <div class="form-group">
                                <label for="Apass" class="col-form-label">Password :</label>
                                <input type="Password" class="form-control" name="ppas" id="Apass" required="">
                            </div>
                            <div class="form-group">
                                <label for="Apass" class="col-form-label">Konfirmasi Password :</label>
                                <input type="Password" class="form-control" name="kpas" id="Apass" required="">
                            </div>
                            <div class="form-group">
                                <label for="Anama" class="col-form-label">Nama :</label>
                                <input type="text" class="form-control" name="pnama" id="Anama" required="">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Alamat :</label>
                                <textarea class="form-control" name="palamat" id="message-text" required=""></textarea>
                            </div>

                            <div class="form-group">
                                <label for="Ahp" class="col-form-label">HP :</label>
                                <input type="text" name="ptlp" class="form-control" id="Ahp" required="">
                            </div>

                            <input type="text" name="clevel" value="admin" style="display: none;">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
                        <button type="submit" name="btndaftar" class="btn btn-primary">Daftar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Modal Ubah Data -->

        <div class="modal fade" id="ubah_data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark font-weight-bold" id="exampleModalLabel"><i class="fa fa-user-edit fa-lg"></i> Ubah Data Admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" class="font-weight-bold">

                            <input type="text" name="id_u_user" hidden="" value="<?= $id_ubah; ?>">

                            <div class="form-group">
                                <label for="Ausername" class="col-form-label">Username :</label>
                                <input type="text" class="form-control" name="u_username" id="Ausername" required="" value="<?= $d_ubah['username']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="Apass" class="col-form-label">Password :</label>
                                <input type="text" class="form-control" name="u_pas" id="Apass" required="" value="<?= $pas; ?>">
                            </div>
                            <div class="form-group">
                                <label for="Apass" class="col-form-label">Konfirmasi Ubah Password :</label>
                                <input type="Password" class="form-control" name="u_kpas" id="Apass" required="">
                            </div>
                            <div class="form-group">
                                <label for="Unama" class="col-form-label">Nama :</label>
                                <input type="text" class="form-control" name="u_nama" id="Anama" required="" value="<?= $d_ubah['nama'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Alamat :</label>
                                <textarea class="form-control" name="u_alamat" id="message-text" required=""><?= $d_ubah['alamat'] ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="Ahp" class="col-form-label">HP :</label>
                                <input type="text" name="u_tlp" class="form-control" id="Ahp" required="" value="<?= $d_ubah['hp'] ?>">
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
                        <button type="submit" name="btnubah" class="btn btn-primary" onclick="return confirm('Anda Yakin Ingin Mengubah Data Akun?');">Ubah</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </section>
    <!-- End of Main Content -->






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