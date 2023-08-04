<?php
session_start();

if (!isset($_SESSION["level2"])) {
    header("Location: ../index.php");
    exit;
}


require '../functions.php';


if (isset($_POST["reset"])) {

    $_SESSION["keywordp"] = "";

    header("Location:?hal=1");
}



$jdataP = count(query("SELECT * FROM tpenyakit"));

//pagenation

$batas = 5000;

if (isset($_SESSION["keywordp"])) {

    $keyword = $_SESSION["keywordp"];


    $jdata = count(query("SELECT * FROM tpenyakit WHERE 
                          id_penyakit LIKE '%$keyword%' OR
                          n_penyakit LIKE '%$keyword%'"));
} elseif (!isset($_SESSION["keywordp"])) {

    $jdata = count(query("SELECT * FROM tpenyakit"));
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

if (isset($_SESSION["keywordp"])) {

    $penyakitt = "SELECT * FROM tpenyakit WHERE
            id_penyakit LIKE '%$keyword%' OR
            n_penyakit LIKE '%$keyword%' ORDER BY 
            id_penyakit ASC LIMIT $hal_awal,$batas";

    $penyakit = query($penyakitt);
} elseif (!isset($_SESSION["keywordp"])) {

    $penyakit = query("SELECT * FROM tpenyakit ORDER BY id_penyakit DESC LIMIT $hal_awal, $batas");
}



//tambah penyakit

if (isset($_POST["btnsimpan"])) {

    //masukan data registrasi kedalam variabel

    if (simpanP($_POST) > 0) {

        echo "
    <script>
    alert('Data gangguan berhasil disimpan!');
    document.location = 'penyakit.php';
    </script>
    ";
    } else {
        echo "<script>
    alert('Data gangguan gagal disimpan!');
    document.location = 'penyakit.php';
    </script>
    ";
    }
}

//akhir tambah penyakit

//hapus data penyakit

if (isset($_POST["btnhapusPe"])) {

    if (hapusPenyakit($_POST) > 0) {

        echo "
    <script>
    alert('Data gangguan berhasil dihapus!');    
    document.location = 'penyakit.php';
    </script>
    ";
    } else {

        echo "<script>
    alert('Data gangguan gagal dihapus!');
    document.location = 'penyakit.php';
    </script>
    ";
    }
}

//ubah data penyakit

if (isset($_POST["btnubah"])) {

    if (ubahP($_POST) > 0) {

        echo "
    <script>
    alert('Data gangguan berhasil diubah!');    
    document.location = 'penyakit.php';
    </script>
    ";
    } else {

        echo "<script>
    alert('Data gangguan gagal diubah!');
    document.location = 'penyakit.php';
    </script>
    ";
    }
}


// id penyakit

$query = "SELECT max(id_penyakit) as max_code FROM tpenyakit";

$hasil = mysqli_query($conn, $query);

$data = mysqli_fetch_assoc($hasil);

$id = $data['max_code'];

$urutan = (int)substr($id, 2, 4);

$urutan++;

$huruf = 'JG';

$id_penyakit = $huruf . sprintf("%02s", $urutan);


// akhir id penyakit

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
            <li class="nav-item bg-gradient-primary">
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

                    <!-- Topbar  -->
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
                                        <input type="text" class="form-control bg-light border-0 small keyword" id="keywordp2" placeholder="Cari.." aria-label="Search" aria-describedby="basic-addon2" name="keywordp2">

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
                                <h5 class="h5 text-gray-800 pt-1"><i class="fa fa-viruses"></i> (<?= $jdataP; ?>)
                                    Gangguan</h5>

                            </div>

                            <div class="col" id="btn_reg">



                                <!-- register admin -->

                                <button class="btn btn-light text-primary mb-1 font-weight-bold btn-sm border border-primary rounded-pill" style="margin-left: 150px;" data-toggle="modal" data-target="#exampleModal" type="button" id="btn-admin">Tambah Gangguan <i class="fa fa-file-medical"></i></button>

                                <a href="../pcetak.php" class="btn btn-light text-primary border border-primary rounded-pill font-weight-bold mb-1 btn-sm">Cetak
                                    <i class="fa fa-print"></i></a>

                            </div>

                        </div>
                        <hr>

                        <!-- tabel data user -->

                        <div class="row">
                            <div class="col">
                                <div class="card highlight ">
                                    <div class="card-header bg-primary text-white font-weight-bold">
                                        Tabel Data Gangguan
                                    </div>
                                    <div class="card-body ">
                                        <div class="table-responsive">
                                            <div id="cari">
                                                <?php if (isset($_SESSION["keywordp"])) : ?>
                                                    <?php if ($keyword != "") : ?>

                                                        <p id="jhp">Terdapat <?= $jdata; ?> hasil pencarian untuk <i class="text-info"><?= $keyword; ?></i></p>

                                                    <?php endif; ?>
                                                <?php endif; ?>

                                                <table id="table" class="table" style="color: black;" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th>No.</th>
                                                            <th>ID</th>
                                                            <th>Gangguan</th>
                                                            <th>Solusi</th>
                                                            <th>Aksi</th>

                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php
                                                        $nomor = $hal_awal + 1;

                                                        foreach ($penyakit as $pen) :
                                                        ?>

                                                            <tr>
                                                                <td class="text-center"><?= $nomor++; ?></td>
                                                                <td class="text-center"><?= $pen['id_penyakit']; ?></td>
                                                                <td class="font-weight-bold text-capitalize">
                                                                    <?= $pen['n_penyakit']; ?></td>
                                                                <td class="font-weight-bold text-capitalize">
                                                                    <?= $pen['solusi']; ?></td>
                                                                <td class="text-center" style="white-space:nowrap;">
                                                                    <a id="ubahp" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ubah_data<?= $pen['id_penyakit'] ?>"><i class="fa fa-edit"></i> edit</a>
                                                                    <a id="hapus" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_data_peny<?= $pen['id_penyakit']; ?>"><i class="fa fa-trash"></i> hapus</a>
                                                                </td>
                                                            </tr>


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


        <!-- Modal tambah penyakit -->

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark font-weight-bold" id="exampleModalLabel"><i class="fa fa-file-medical fa-lg"></i> Tambah Gangguan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" class="font-weight-bold">

                            <div class="form-group">
                                <label for="idP" class="col-form-label">ID :</label>
                                <input class="form-control" type="text" id="idP" name="idP" readonly value="<?= $id_penyakit; ?>">
                            </div>

                            <div class="form-group">
                                <label for="npenyakit" class="col-form-label">Gangguan :</label>
                                <input type="text" class="form-control" name="npenyakit" id="npenyakit" required="">
                            </div>

                            <div class="form-group">
                                <label for="solusi" class="col-form-label">Solusi :</label>
                                <textarea rows="5" cols="" class="form-control" name="tsolusi" required></textarea>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
                        <button type="submit" name="btnsimpan" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Hapus data Modal-->
        <?php foreach ($penyakit as $peny) : ?>
            <form method="post" action="">
                <div class="modal fade" id="hapus_data_peny<?= $peny['id_penyakit'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Hapus</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <input class="form-control" type="text" id="uidP" name="uidP" hidden value="<?= $peny['id_penyakit'] ?>">
                            <div class=" modal-body">Anda yakin ingin hapus gangguan <b><?= $peny['n_penyakit'] ?></b>?
                            </div>
                            <div class="modal-footer">
                                <a class="btn btn-primary" href="">Keluar</a>
                                <button type="submit" class="btn btn-primary" name="btnhapusPe">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        <?php endforeach; ?>

        <!-- Modal Ubah Data penyakit -->
        <?php foreach ($penyakit as $penya) : ?>
            <div class="modal fade" id="ubah_data<?= $penya['id_penyakit'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-dark font-weight-bold" id="exampleModalLabel"><i class="fa fa-edit fa-lg"></i> Ubah Data Gangguan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" class="font-weight-bold">

                                <div class="form-group">
                                    <label for="uidP" class="col-form-label">ID :</label>
                                    <input class="form-control" type="text" value="<?= $penya['id_penyakit'] ?>" name="uidP" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="unpenyakit" class="col-form-label">Gangguan :</label>
                                    <input type="text" class="form-control" value="<?= $penya['n_penyakit'] ?>" name="unpenyakit" required="">
                                </div>
                                <div class="form-group">
                                    <label for="solusi" class="col-form-label">Solusi :</label>
                                    <textarea rows="5" cols="" class="form-control" name="solusi" required><?= $penya['solusi'] ?></textarea>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
                            <button type="submit" name="btnubah" class="btn btn-primary" onclick="return confirm('Anda Yakin Ingin Mengubah Data Gangguan?');">Ubah</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

</body>
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- <script src="../js/jquery-3.6.0.min.js"></script> -->
<script src="js/cari.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#table').DataTable();
    });
</script>

<script type='text/javascript'>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

</html>