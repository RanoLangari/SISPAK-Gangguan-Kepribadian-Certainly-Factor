<?php
session_start();

if (isset($_SESSION['level1'])) {

    $ready = true;
} elseif (isset($_SESSION['level2'])) {

    header("Location: admin/index.php");
}

//login gagal

if (isset($_GET["x"])) {

    if ($_GET["x"] == "fail") {

        $error = true;
    }
}

require 'functions.php';

//Registrasi Akun

if (isset($_POST["btndaftar"])) {

    //masukan data registrasi kedalam variabel

    if (registrasi($_POST) > 0) {

        echo "
			<script>
				alert('Registrasi Akun Berhasil!');
				document.location = 'index.php';
			</script>
		";
    } else {
        echo "<script>
				alert('Registrasi Akun Gagal!');
				document.location = 'index.php';
			</script>
			";
    }
}

//akhir registrasi akun


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

//ubah data

if (isset($ready)) {

    $id_ubah = $_SESSION["id"];
    $pas = $_SESSION["pas"];

    $d_ubah = query("SELECT * FROM tuser WHERE id_tuser = '$id_ubah'")[0];

    if (isset($_POST["btnubah"])) {

        if (ubah($_POST) > 0) {

            echo "
			<script>
			alert('Ubah Data Akun Berhasil!');
			document.location = 'index.php';
			</script>
			";
        } else {

            echo "<script>
			alert('Ubah Data Akun Gagal!');
			document.location = 'index.php';
			</script>
			";
        }
    }
}



?>

<!DOCTYPE html>
<html id="home">

<head>
    <title>Gangguan Kepribadian</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- css -->

    <?php if (isset($ready)) : ?>

        <style>
            #daftar {
                display: none;
            }

            #flogin {
                display: none;
            }

            .navdaftar {

                display: none;
            }

            .hello {
                display: none;
            }
        </style>

    <?php endif; ?>

</head>

<body>

    <!-- 
<-- mulai nav -->
    <section>
        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-primary">
            <ul class="navbar-nav  ml-auto">
                <?php if (isset($ready)) : ?>
                    <li class="nav-item dropdown pb-3 " style="margin-top: 2px; margin-right: 120px">
                        <a class="dropdown-toggle active text-decoration-none text-reset" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-profile rounded-circle " src="admin/img/undraw_profile.svg" style="width: 30px;"> <b class="lead" style="color: white;"><?= $_SESSION['nama']; ?></b></a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item text-dark font-weight-bold page-sc" href="#riwayat"><i class="fa fa-history"></i> Riwayat Konsultasi</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-dark font-weight-bold" data-toggle="modal" data-target="#ubah_data" href="#ubah_data"><i class="fa fa-user-edit"></i> Kelola Akun</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-primary font-weight-bold shadow" href="logout.php" onclick="return confirm('Anda yakin ingin keluar?')"><i class="fas fa-sign-out-alt"></i>
                                Keluar</a>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

    </section>
    <!-- akhir nav -->


    <!-- mulai jumbotron -->
    <section id="jumbo" class="jumbo pt-5">
        <div class="container ">

            <div class="col-lg-4" id="flogin" style="text-align : center; margin-left:350px; margin-top: 100px;">
                <div class="card mt-4">
                    <div class="card-header bg-primary font-weight-bold text-light">
                        <i class="fas fa-house-user fa-lg"></i> L O G I N

                        <?php if (isset($error)) : ?>
                            <hr>
                            <p class="text-white text-center text-monospace bg-primary mb-1 shadow"><i class="fas fa-exclamation-triangle"></i> username/password salah!</p>
                        <?php endif; ?>

                    </div>
                    <div class="card-body bg-transparent">
                        <form action="login.php" method="post">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="lusername" required="" class="form-control" id="username" autofocus="">
                            </div>

                            <div class="form-group">
                                <label for="pass">Password</label>
                                <input type="password" name="lpass" required="" class="form-control" id="pass">
                            </div>

                            <div class="row pt-2">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary" name="btnlog">Masuk</button>
                                </div>

                                <div class="col pt-2">
                                    <a href="#daftar" class="page-sc" style="font-size: 12px">Belum memiliki akun?</a>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        </div>
        </div>
    </section>

    <!-- akhir jumbotron -->

    <!-- awal daftar -->

    <section id="daftar" class="daftar pt-5 pb-5" style="margin-top: 150px;">
        <div class="container">
            <h1 class="text-center pb-4">Pendaftaran Akun</h1>
            <div class="card mt-2">
                <div class="card-header bg-primary text-white font-weight-bold lead">
                    Form Pendaftaran
                </div>
                <div class="card-body">
                    <form action="" method="post">

                        <input type="text" name="iduser" value="<?= $id_user ?>" style="display: none;">

                        <div class="form-group">
                            <label for="pusername">Username</label>
                            <input type="text" name="pusername" required="" class="form-control" id="pusername">
                        </div>

                        <div class="form-group">

                            <label for="ppas">Password </label>
                            <input type="password" name="ppas" required="" class="form-control" id="ppas" minlength="6">
                        </div>

                        <div class="form-group">
                            <label for="kpas">Konfirmasi Password</label>
                            <input type="password" name="kpas" required="" class="form-control" id="kpas">
                        </div>


                        <div class="form-group">
                            <label for="pnama">Nama Lengkap</label>
                            <input type="text" name="pnama" required="" class="form-control" id="pnama">
                        </div>
                        <div class="form-group">
                            <label for="pjk">Jenis Kelamin</label>
                            <select name="pjk" required="" class="form-control" id="pjk">
                                <option value="">-- Jenis Kelamin --</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pprodi">Program Studi</label>
                            <select class="form-control" name="pprodi" required>
                                <option value="" disabled selected>-- program studi --</option>
                                <option>Matematika</option>
                                <option>Kimia</option>
                                <option>Fisika</option>
                                <option>Biologi</option>
                                <option>Ilmu Komputer</option>
                                <option>Teknik Sipil</option>
                                <option>Teknik Elektro</option>
                                <option>Teknik Arsitektur</option>
                                <option>Teknik Mesin</option>
                                <option>Teknik Pertambangan</option>
                                <option>Teknik Pembuatan Tenun Ikat</option>
                            </select>
                            <!--<input type="text" name="pprodi" required="" class="form-control" id="pprodi">-->
                        </div>

                        <div class="form-group">
                            <label for="palamat">Alamat</label>
                            <textarea class="form-control " required="" name="palamat" id="palamat"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="ptlp">No HP</label>
                            <input type="number" name="ptlp" required="" class="form-control" id="ptlp" min="0">
                        </div>

                        <input type="text" name="clevel" value="client" style="display: none;">

                        <button type="submit" class="btn btn-primary mt-3" name="btndaftar">Daftar</button>

                    </form>
                </div>
            </div>


        </div>
    </section>

    <!-- akhir daftar -->
    <?php if (isset($ready)) : ?>

        <section id="" class=" pt-5 pb-5  ">
            <div class="container ">

                <h1 class="text-center pb-4">Konsultasi</h1>

                <div class="card mt-3">
                    <div class="card-header bg-dark text-white font-weight-bold lead">
                        Panduan Konsultasi
                    </div>
                    <div class="card-body">
                        <p class="text-black">Pilih gejala dan tentukan tingkat keyakinan terjadinya gejala yang anda alami
                            selama ini dalam rentang waktu tahunan sesuai catatan riwayat gejala yang anda miliki atau
                            ingat, pada form yang tersedia.
                            <br> Cara menjawab tingkat keyakinan:
                            <br>
                        <ol>
                            <li>Pilihan “selalu” dipilih jika anda selalu merasakan gejala tersebut.</li>
                            <li>Pilihan “sering” dapat anda pilih jika perbandingan anda merasakan gejalanya lebih besar
                                dibandingkan saat anda tidak merasakan gejala. Contohnya pada bulan bulan tertentu anda
                                merasakannya tapi ada juga disaat anda tidak merasakan gejalanya pada bulan tersebut.</li>
                            <li>Pilihan “kadang” dapat anda pilih jika perbandingan anda merasakan sama atau hampir sama
                                dengan saat anda tidak merasakan gejala tersebut. Contohnya 1 minggu pertama anda merasakan
                                gejalnya dan 1 minggu berikutnya anda tidak merasakan gejalanya.</li>
                            <li>Pilihan “jarang” dapat anda pilih jika perbandingan anda merasakan gejala lebih kecil
                                dibandingkan saat anda tidak merasakan gejala tersebut. Contohnya dari 1 minggu, 3 hari anda
                                merasakan gejala dan 4 hari anda tidak merasakan gejala tersebut.</li>
                            <li>Pilihan “tidak tahu” dapat anda pilih jika anda tidak yakin mengalami gejala tersebut.</li>
                            <li>Pilihan “tidak pernah” dapat anda pilih jika selama ini anda tidak pernah merasakan gejala
                                tersebut.</li>
                        </ol>
                        <br> Selanjutnya pilih Tombol Tambah untuk memasukan data kedalam Tabel Data Diagnosis. Setelah
                        itu silahkan memilih Tombol Diagnosa untuk melanjutkan proses Diagnosis.
                        </p>
                    </div>
                </div>
                <div class="row justify-content-center pt-2">
                    <div class="col" style="margin-left : 1000px; margin-top : 35px;">
                        <a href="./pages/pert1.php" class="btn btn-primary btn-lg rounded-pill shadow">Mulai Konsultasi</a>
                    </div>
                </div>

            </div>
        </section>

    <?php endif; ?>

    <!-- awal Riwayat Konsultasi -->
    <?php if (isset($ready)) : ?>

        <section id="riwayat" class="riwayat pt-5 pb-5  ">
            <div class="container ">

                <h1 class="text-center pb-4">Riwayat Konsultasi</h1>

                <div class="card mt-3">
                    <div class="card-header bg-dark text-white font-weight-bold lead">
                        Tabel Riwayat
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-striped">

                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>ID</th>
                                        <th>Gangguan</th>
                                        <th>Persentase</th>
                                        <th>Solusi</th>
                                        <th>Waktu</th>
                                    </tr>

                                    <?php

                                    $user = $_SESSION['username'];

                                    //ambil ID user 

                                    $datau = mysqli_query($conn, "SELECT id_tuser FROM tuser WHERE username = '$user'");

                                    $iduu = mysqli_fetch_assoc($datau);

                                    $idu = $iduu["id_tuser"];

                                    $kons = query("SELECT * FROM konsultasi WHERE id_kuser = '$idu' ORDER BY id_konsultasi DESC");

                                    ?>

                                    <?php $no = 1;
                                    foreach ($kons as $ko) : ?>

                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td class="text-center font-weight-bold"><?= $ko['id_konsultasi']; ?></td>
                                            <td class="font-weight-bold text-primary text-capitalize text-center">
                                                <?= $ko['kpenyakit']; ?></td>
                                            <td class="font-weight-bold text-capitalize text-center"><?= $ko['persentase']; ?>%
                                            </td>

                                            <?php

                                            $idpenyakit = $ko["id_kpenyakit"];
                                            $dsol = mysqli_query($conn, "SELECT solusi FROM tpenyakit WHERE id_penyakit ='$idpenyakit'");
                                            $solu = mysqli_fetch_assoc($dsol);
                                            $solusi = $solu["solusi"];

                                            ?>

                                            <td class="font-weight-bold text-capitalize"><?= $solusi; ?></td>
                                            <td class="text-capitalize text-justify"><?= $ko['kdate']; ?></td>
                                        </tr>

                                    <?php endforeach; ?>


                                </table>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </section>

    <?php endif; ?>

    <!-- akhir Riwayat Konsultasi -->

    <!-- Modal Ubah Data -->

    <div class="modal fade" id="ubah_data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark font-weight-bold" id="exampleModalLabel"><i class="fa fa-user-edit fa-lg"></i> UBAH DATA USER</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" class="font-weight-bold">

                        <input type="text" name="id_u_user" hidden="" value="<?= $id_ubah; ?>">

                        <div class="form-group">
                            <label for="Ausername" class="col-form-label">Username :</label>
                            <input type="text" class="form-control" name="u_username" id="Ausername" required="" value="<?= $d_ubah['username'] ?>" readonly>
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
                            <label for="u_jk">Jenis Kelamin</label>
                            <select name="u_jk" required="" class="form-control" id="u_jk">
                                <option value="">-- Jenis Kelamin --</option>
                                <option <?= $d_ubah['jenis_kelamin'] == "Laki-Laki" ? "selected" : "" ?> value="Laki-Laki">
                                    Laki-Laki</option>
                                <option <?= $d_ubah['jenis_kelamin'] == "Perempuan" ? "selected" : "" ?> value="Perempuan">
                                    Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="u_prodi">Prodi</label>
                            <input type="text" value="<?= $d_ubah['prodi'] ?>" name="u_prodi" required="" class="form-control" id="u_prodi">
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


    <!-- awal foter -->


    <section id="foot" class="foot pt-0 mt-0">
        <footer class="bg-dark text-white">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col text-center pt-5 pb-4">
                        <p class="mr-4"> &copy; Copyright <strong><span>Sistem Pakar | Gangguan
                                    Kepribadian</span></strong>. All
                            Rights Reserved</p>
                    </div>
                </div>
            </div>
        </footer>
    </section>

    <!-- akhir foter -->



    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script> -->


    <script src="js/jquery-3.6.0.min.js"></script>

    <script src="js/jquery.easing.1.3.js"></script>

    <script src="js/bootstrap.min.js">

    </script>

    <script src="js/script.js"></script>


</body>

<script type='text/javascript'>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

</html>