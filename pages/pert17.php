<?php
session_start();

if (!isset($_SESSION['level1'])) {
    header("Location: ../index.php");
    exit;
}
require '../functions.php';
$user = $_SESSION['username'];
$queryData = "SELECT * FROM tgejala WHERE id_gejala = 'G17'";
$gejala = mysqli_query($conn, $queryData);
$fetchGejala = mysqli_fetch_assoc($gejala);


// cek data gejala sudah ada atau belum
$queryCek = "SELECT * FROM diagnosis LEFT JOIN tuser ON diagnosis.idduser = tuser.id_tuser WHERE tuser.username = '$user' AND diagnosis.iddgej = 'G17'";
$cek = mysqli_query($conn, $queryCek);
$fetchCek = mysqli_fetch_assoc($cek);
if (mysqli_num_rows($cek) > 0) {
    $setData = $fetchCek['dfrasa'];
} else {
    $setData = "";
}



if (isset($_POST["tambah"])) {


    if (tmbgejala($_POST) > 0) {

        echo "
    <script>
    document.location = 'pert18.php'; 
    </script>
    ";
    } else {

        echo "
    <script>
    alert('Tambah Gejala Gagal!!');
    document.location = 'pert17.php';
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
    <title>Kuisioner Halaman 17</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .box {
            width: 50px;
            height: 50px;
            background-color: #fff;
            border: 1px solid #000;
            margin: 10px;
            text-align: center;
            line-height: 50px;
            float: left;
        }

        .box:hover {
            background-color: #ccc;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class=" card">
            <div class="card-header">
                <h3 class="mb-0">GEJELA 17</h3>
                <br>
                <h5><?= $fetchGejala['n_gejala']; ?></h5>
            </div>

            <div class="card-body">
                <form action="" method="post">
                    <input type="text" hidden name="un" value="<?= $user; ?>">
                    <input type="text" hidden name="idd" value="<?= $idd; ?>">
                    <input type="hidden" name="dgejala" value="<?= $fetchGejala['id_gejala']; ?>">
                    <div class="form-group h7">
                        <label for="pertanyaan">Silahkan Pilih Tingkat keyakinan</label>
                        <div class="form-group h7">
                            <?php
                            $options = array("selalu", "sering", "kadang", "jarang", "tidak tahu", "tidak pernah");
                            foreach ($options as $option) {
                                $key = array_search($option, $options);
                                $checked = ($setData === $option) ? "checked" : "";
                            ?>
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="radio" name="ptk" id="<?= "op" . ($key + 1); ?>" value="<?= $option; ?>" <?= $checked; ?> required>
                                    <label class="form-check-label" for="<?= "op" . ($key + 1); ?>">
                                        <?= ucfirst($option); ?>
                                    </label>
                                </div>
                            <?php } ?>

                        </div>

                    </div>
                    <!-- div button next and previos -->
                    <div class="row mt-5">
                        <div class="col d-flex justify-content-start">
                            <a href="pert16.php" class="btn btn-primary float-left btn-lg">Previous</a>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <button type="submit" name="tambah" class="btn btn-primary float-right btn-lg">Next</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <?php for ($i = 1; $i <= 46; $i++) : ?>
                    <?php
                    $val = 'G' . sprintf('%02s', $i);
                    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM diagnosis LEFT JOIN tuser ON diagnosis.idduser = tuser.id_tuser WHERE tuser.username = '$user' AND diagnosis.iddgej = '$val'")) > 0) {
                        $warna = "bg-success text-white";
                    } else {
                        $warna = "bg-none text-black";
                    }
                    ?>
                    <a href="<?= "pert" . $i . ".php"; ?>" class="box <?= $warna; ?>"><?= $i; ?></a>
                <?php endfor; ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional, for additional functionality) -->
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>