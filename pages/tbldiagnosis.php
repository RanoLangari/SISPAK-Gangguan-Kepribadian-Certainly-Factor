<?php
session_start();

if (!isset($_SESSION['level1'])) {
    header("Location: ../index.php");
    exit;
}
require '../functions.php';
$user = $_SESSION['username'];
$queryData = "SELECT * FROM tgejala WHERE id_gejala = 'G46'";
$gejala = mysqli_query($conn, $queryData);
$fetchGejala = mysqli_fetch_assoc($gejala);


// cek data gejala sudah ada atau belum
$queryCek = "SELECT * FROM diagnosis LEFT JOIN tuser ON diagnosis.idduser = tuser.id_tuser WHERE tuser.username = '$user' AND diagnosis.iddgej = 'G46'";
$cek = mysqli_query($conn, $queryCek);
$fetchCek = mysqli_fetch_assoc($cek);
if (mysqli_num_rows($cek) > 0) {
    $setData = $fetchCek['dfrasa'];
} else {
    $setData = "";
}


if (isset($_POST["diagnosis"])) {
    for ($i = 1; $i <= 46; $i++) {
        $val = 'G' . sprintf('%02s', $i);
        $queryCek = "SELECT * FROM diagnosis LEFT JOIN tuser ON diagnosis.idduser = tuser.id_tuser WHERE tuser.username = '$user' AND diagnosis.iddgej = '$val'";
        $cek = mysqli_query($conn, $queryCek);
        // insert to array
        $dataCek[] = mysqli_num_rows($cek);
    }
    $key = array_search(0, $dataCek);
    if (empty($key)) {
        header("Location: ../hdiagnosis.php");
    } else {
        echo "
        <script>
        alert('Harap Mengisi Semua Gejala');
        document.location = 'pert46.php';
        </script>
        ";
    }
}

// id Diagnosis

$query = "SELECT max(id_d) as max_code FROM diagnosis";

$hasil = mysqli_query($conn, $query);

$data = mysqli_fetch_assoc($hasil);

$id = $data['max_code'];

$urutan = (int)substr($id, 1, 3);

$urutan++;

$huruf = 'D';

$idd = $huruf . sprintf("%02s", $urutan);

// akhir id diagnosis


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Gejala</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="card">

            <div class="card">

                <div class=" card-header bg-primary">
                    <div class="card-title font-weight-bold text-white">
                        <h5 class="text-center">Tabel gejala</h5>
                    </div>
                </div>
                <table class="table table-bordered table-striped">
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Gejala</th>
                        <th>Keyakinan</th>
                    </tr>

                    <?php

                    //ambil ID user 

                    $datau = mysqli_query($conn, "SELECT id_tuser FROM tuser WHERE username = '$user'");

                    $iduu = mysqli_fetch_assoc($datau);

                    $idu = $iduu["id_tuser"];


                    $ddiagnosis = query("SELECT * FROM diagnosis WHERE idduser = '$idu'");

                    ?>

                    <?php $i = 1;
                    foreach ($ddiagnosis as $diag) : ?>
                        <tr>
                            <td class="text-center"><?= $i++; ?></td>
                            <td class="text-capitalize font-weight-bold"><?= $diag["dgej"]; ?></td>
                            <td class="text-capitalize text-center"><?= $diag["dfrasa"]; ?></td>

                        </tr>



                    <?php endforeach; ?>

                </table>

            </div>
            <!-- div button next and previos -->
            <div class="row mt-5 mb-3">
                <div class="col d-flex justify-content-start" style="margin-left: 10px;">
                    <a href="pert46.php" class="btn btn-primary float-left btn-lg">Previous</a>
                </div>
                <div class="col d-flex justify-content-end" style="margin-right: 10px;">
                    <form action="" method="post">
                        <input type="text" hidden name="un" value="<?= $user; ?>">
                        <input type="text" hidden name="idd" value="<?= $idd; ?>">
                        <input type="hidden" name="dgejala" value="<?= $fetchGejala['id_gejala']; ?>">
                        <button type="submit" name="diagnosis" class="btn btn-primary float-right btn-lg">Diagnosa</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS (optional, for additional functionality) -->
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>


</html>