<?php
session_start();

if (!isset($_SESSION["level2"])) {
    header("Location: ../index.php");
    exit;
}

require '../functions.php';

if (isset($_POST["reset"])) {

    $_SESSION["keyworda"] = "";

    header("Location:?hal=1");
}

$jdataA = count(query("SELECT * FROM taturancf"));

//pagenation

$batas = 100000000;

if (isset($_SESSION["keyworda"])) {

    $keyword = $_SESSION["keyworda"];


    $jdata = count(query("SELECT * FROM taturancf WHERE 
                          id_cf LIKE '%$keyword%' OR
                          agejala LIKE '%$keyword%' OR
                          apenyakit LIKE '%$keyword%' OR
                          frasa LIKE '%$keyword%' OR
                          bobotcf LIKE '%$keyword%'"));
} elseif (!isset($_SESSION["keyworda"])) {

    $jdata = count(query("SELECT * FROM taturancf"));
}


$jhal = ceil($jdata / $batas);


// ternari (halaman aktif)

$hal = (isset($_GET["hal"])) ? $_GET["hal"] : 1;

$hal_awal = ($batas * $hal) - $batas;


//limit pagination

$bts_hal = 5000000;

$send_num = ($hal < ($jhal - $bts_hal)) ? $hal + $bts_hal : $hal;


//akhir pagenation

//query data

if (isset($_SESSION["keyworda"])) {

    $aturancf = "SELECT * FROM taturancf WHERE
                id_cf LIKE '%$keyword%' OR
                agejala LIKE '%$keyword%' OR
                apenyakit LIKE '%$keyword%' OR
                frasa LIKE '%$keyword%' OR
                bobotcf LIKE '%$keyword%' ORDER BY 
                id_cf DESC LIMIT $hal_awal,$batas";

    $aturan = query($aturancf);
} elseif (!isset($_SESSION["keyworda"])) {

    $aturan = query("SELECT * FROM taturancf ORDER BY id_cf DESC LIMIT $hal_awal, $batas");
}

//tambah aturan

if (isset($_POST["btnsimpan"])) {


    if (simpanA($_POST) > 0) {

        echo "
    <script>
    alert('Data aturan berhasil disimpan!');
    document.location = 'aturan.php';
    </script>
    ";
    } else {
        echo "<script>
    alert('Data aturan gagal disimpan!');
    document.location = 'aturan.php';
    </script>
    ";
    }
}

//akhir tambah aturan


//ubah data aturan

if (isset($_POST["btnubah"])) {

    if (ubahA($_POST) > 0) {

        echo "
    <script>
    alert('Data aturan berhasil diubah!');    
    document.location = 'aturan.php';
    </script>
    ";
    } else {

        echo "<script>
    alert('Data aturan gagal diubah!');
    document.location = 'aturan.php';
    </script>
    ";
    }
}

//hapus data aturan

if (isset($_GET['ida'])) {

    $id = $_GET['ida'];

    if (hapusA($id) > 0) {

        header("Location: aturan.php");
    }
}

// id aturan

$query = "SELECT max(id_cf) as max_code FROM taturancf";

$hasil = mysqli_query($conn, $query);

$data = mysqli_fetch_assoc($hasil);

$id = $data['max_code'];

$urutan = (int)substr($id, 1, 3);

$urutan++;

$huruf = 'A';

$id_cf = $huruf . sprintf("%02s", $urutan);

// akhir id aturan

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
            <li class="nav-item bg-gradient-primary">
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

                    <!-- Topbar -->
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
                                        <input type="text" class="form-control bg-light border-0 small keyword" id="keyworda2" placeholder="Cari.." aria-label="Search" aria-describedby="basic-addon2" name="keyworda2">

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
                                <h5 class="h5 text-gray-800 pt-1"><i class="fa fa-cog"></i> (<?= $jdataA; ?>) Aturan
                                </h5>

                            </div>

                            <div class="col" id="btn_reg">



                                <!-- register admin -->

                                <button class="btn btn-light text-primary mb-1 font-weight-bold btn-sm border border-primary rounded-pill" style="margin-left:170px;" data-toggle="modal" data-target="#exampleModal" type="button" id="btn-admin">Tambah Aturan <i class="fa fa-file-medical"></i></button>

                                <a href="../acetak.php" class="btn btn-light text-primary border border-primary rounded-pill font-weight-bold mb-1 btn-sm">Cetak
                                    <i class="fa fa-print"></i></a>


                            </div>

                        </div>
                        <hr>

                        <!-- tabel data user -->

                        <div class="row">
                            <div class="col">

                                <div class="card highlight ">
                                    <div class="card-header text-white bg-primary font-weight-bold ">
                                        Tabel Data Aturan
                                    </div>
                                    <div class="card-body ">
                                        <div class="table-responsive">
                                            <div id="cari">

                                                <?php if (isset($_SESSION["keyworda"])) : ?>
                                                    <?php if ($keyword != "") : ?>

                                                        <p id="jhp">Terdapat <?= $jdata; ?> hasil pencarian untuk <i class="text-info"><?= $keyword; ?></i></p>

                                                    <?php endif; ?>
                                                <?php endif; ?>

                                                <table id="example" class="table" style="color: black;">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th>No.</th>
                                                            <th>ID</th>
                                                            <th>Gejala</th>
                                                            <th>Gangguan</th>
                                                            <th>Keyakinan</th>
                                                            <th>Bobot Pakar</th>
                                                            <th>Aksi</th>

                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php
                                                        $nomor = $hal_awal + 1;

                                                        foreach ($aturan as $atr) :
                                                        ?>

                                                            <tr>
                                                                <td class="text-center col-md-1"><?= $nomor++; ?></td>
                                                                <td class="text-center"><?= $atr['id_cf']; ?></td>
                                                                <td class="text-left text-capitalize"><?= $atr['agejala']; ?></td>
                                                                <td class="font-weight-bold text-capitalize text-primary text-center">
                                                                    <?= $atr['apenyakit']; ?></td>
                                                                <td class="text-capitalize text-center"><?= $atr['frasa']; ?></td>
                                                                <td class="text-capitalize text-center"><?= $atr['bobotcf']; ?>
                                                                </td>
                                                                <td class="text-center"><a id="ubaha" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ubah_data" data-id="<?= $atr['id_cf']; ?>" data-agejala="<?= $atr['agejala']; ?>" data-apenyakit="<?= $atr['apenyakit']; ?>" data-frasa="<?= $atr['frasa']; ?>"><i class="fa fa-edit"></i></a> <a id="hapusa" href="?ida=<?= $atr['id_cf']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin Ingin Menghapus Data Aturan?');"><i class="fa fa-trash"></i></a></td>
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

        <!-- Modal tambah Aturan -->

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark font-weight-bold" id="exampleModalLabel"><i class="fa fa-file-medical fa-lg"></i> Tambah Data Aturan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" class="font-weight-bold">

                            <div class="form-group">
                                <label for="ida" class="col-form-label">ID :</label>
                                <input class="form-control" type="text" id="ida" name="ida" readonly value="<?= $id_cf; ?>">
                            </div>

                            <?php

                            //query data penyakit

                            $penyakit = query("SELECT * FROM tpenyakit");

                            $gejala = query("SELECT * FROM tgejala");

                            ?>

                            <div class="form-group">
                                <label for="angejala">Gejala :</label>
                                <select class="form-control text-capitalize font-weight-bold" name="angejala" id="angejala" required="">

                                    <option class="font-italic" value="" hidden="" disabled="" selected="">----</option>

                                    <?php foreach ($gejala as $gej) : ?>

                                        <option class="font-weight-bold text-dark" value="<?= $gej['n_gejala']; ?>">
                                            <?= $gej['id_gejala']; ?> : <?= $gej['n_gejala']; ?></option>

                                    <?php endforeach; ?>

                                </select>
                            </div>


                            <div class="form-group">
                                <label for="anpenyakit">Gangguan :</label>
                                <select class="form-control text-capitalize font-weight-bold" name="anpenyakit" id="anpenyakit" required="">

                                    <option class="font-italic" value="" hidden="" disabled="" selected="">----</option>

                                    <?php foreach ($penyakit as $pen) : ?>

                                        <option class="font-weight-bold text-dark" value="<?= $pen["n_penyakit"]; ?>">
                                            <?= $pen["id_penyakit"]; ?> : <?= $pen["n_penyakit"]; ?></option>

                                    <?php endforeach; ?>

                                </select>
                            </div>


                            <div class="form-group">
                                <label for="bkey">Bobot Keyakinan :</label>
                                <select class="form-control text-capitalize font-weight-bold" name="bkey" id="bkey" required="">

                                    <option class="font-italic" value="" hidden="" disabled="" selected="">----</option>

                                    <option class="font-weight-bold text-dark" value="selalu">Selalu (1)</option>
                                    <option class="font-weight-bold text-dark" value="sering">Sering (0.8)</option>
                                    <option class="font-weight-bold text-dark" value="kadang">Kadang (0.6)</option>
                                    <option class="font-weight-bold text-dark" value="jarang">Jarang (0.4)</option>
                                    <option class="font-weight-bold text-dark" value="tidak tahu">Tidak tahu (0.2)
                                    </option>
                                    <option class="font-weight-bold text-dark" value="tidak pernah">Tidak pernah (0)
                                    </option>

                                </select>
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

        <!-- Modal Ubah Data Aturan -->

        <div class="modal fade" id="ubah_data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark font-weight-bold" id="exampleModalLabel"><i class="fa fa-edit fa-lg"></i> Ubah Data Aturan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" class="font-weight-bold">

                            <div class="form-group">
                                <label for="uida" class="col-form-label">ID :</label>
                                <input class="form-control" type="text" id="uida" name="uida" readonly>
                            </div>


                            <?php

                            //query data penyakit

                            $penyakit = query("SELECT * FROM tpenyakit");

                            $gejala = query("SELECT * FROM tgejala");

                            ?>

                            <div class="form-group">
                                <label for="uangejala">Gejala :</label>
                                <select class="form-control text-capitalize font-weight-bold" name="uangejala" id="uangejala" required="">

                                    <option class="font-italic" value="" hidden="" disabled="" selected="">----</option>

                                    <?php foreach ($gejala as $gej) : ?>

                                        <option class="font-weight-bold text-dark" value="<?= $gej['n_gejala']; ?>">
                                            <?= $gej['id_gejala']; ?> : <?= $gej['n_gejala']; ?></option>

                                    <?php endforeach; ?>

                                </select>
                            </div>


                            <div class="form-group">
                                <label for="uanpenyakit">Gangguan :</label>
                                <select class="form-control text-capitalize font-weight-bold" name="uanpenyakit" id="uanpenyakit" required="">

                                    <option class="font-italic" value="" hidden="" disabled="" selected="">----</option>

                                    <?php foreach ($penyakit as $pen) : ?>

                                        <option class="font-weight-bold text-dark" value="<?= $pen["n_penyakit"]; ?>">
                                            <?= $pen["id_penyakit"]; ?> : <?= $pen["n_penyakit"]; ?></option>

                                    <?php endforeach; ?>

                                </select>
                            </div>


                            <div class="form-group">
                                <label for="ubkeyy">Bobot Keyakinan :</label>
                                <select class="form-control text-capitalize font-weight-bold" id="ubkeyy" name="ubkeyy" required="">

                                    <option class="font-italic" value="" hidden="" disabled="" selected="">----</option>

                                    <option class="font-weight-bold text-dark" value="selalu">Selalu (1)</option>
                                    <option class="font-weight-bold text-dark" value="sering">Sering (0.8)</option>
                                    <option class="font-weight-bold text-dark" value="kadang">Kadang (0.6)</option>
                                    <option class="font-weight-bold text-dark" value="jarang">Jarang (0.4)</option>
                                    <option class="font-weight-bold text-dark" value="tidak tahu">Tidak tahu (0.2)
                                    </option>
                                    <option class="font-weight-bold text-dark" value="tidak pernah">Tidak pernah (0)
                                    </option>

                                </select>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
                        <button type="submit" name="btnubah" class="btn btn-primary" onclick="return confirm('Anda Yakin Ingin Mengubah Data Aturan?');">Ubah</button>
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

<!-- <script src="../js/jquery-3.6.0.min.js"></script> -->
<script src="js/cari.js"></script>

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