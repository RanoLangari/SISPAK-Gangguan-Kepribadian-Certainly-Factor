<?php

session_start();

if (!isset($_SESSION["level1"])) {
	header("Location: index.php");
	exit;
}


date_default_timezone_set('Asia/Jakarta');

require_once __DIR__ . '/vendor/autoload.php';


require 'functions.php';

$user = $_SESSION['username'];

//ambil ID user	

$datau = mysqli_query($conn, "SELECT * FROM tuser  WHERE username = '$user'");


$iduu = mysqli_fetch_assoc($datau);

$idu = $iduu["id_tuser"];


//data penyakit, presentase dan id konsultasi

$idk = $_POST["idk"];
$penyakit = $_POST["idkp"];
$persentase = $_POST["pre"];

// var_dump($penyakit);
// exit;	

//ambil ID Penyakit	

$datap = mysqli_query($conn, "SELECT id_penyakit FROM tpenyakit WHERE n_penyakit = '$penyakit'");

$idpp = mysqli_fetch_assoc($datap);

$idp = $idpp["id_penyakit"];




//ambil data solusi
$sol = query("SELECT * FROM solusi WHERE id_spenyakit = '$idp'");

//ambil data diagnosis
$diag = query("SELECT * FROM diagnosis WHERE idduser = '$idu'");




$mpdf = new \Mpdf\Mpdf();

$stylesheet = file_get_contents('css/slaporan.css');

$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);


$html = '<!DOCTYPE html>
<html>
<head>
	<title>Cetak Laporan</title>
</head>
<body>
<table class="t1">
<tr>
<td class="L">
<h2>LAPORAN</h2>
<h5>HASIL DIAGNOSIS</h5>
<h5>GANGGUAN KEPRIBADIAN</h5>
</td>
<td class="sispak">
<h5>Sistem Pakar Diagnosa Gangguan Kepribadian Menggunakan Metode <i>Certainty Factor</i></h5>
</td>
</tr>
</table>

<hr>

<table>

<tr>
<td><b>ID Konsultasi</b></td>
<td>:</td>
<td><b>' . $idk . '</b></td>
</tr>

<tr>
<td><b>Tanggal/Waktu</b></td>
<td>:</td>
<td>';
$html .= '<p class="date">' . date("d/m/Y (h:i:s a)") . '</p>
</td>
</tr>';

foreach ($datau as $du) {
	$html .= '
<tr>
<td><b>Nama</b></td>
<td>:</td>
<td>
<p class="user">' . $idu . " -- <b>" . $du["nama"] . '</b></p>
</td>
</tr>

<tr>
<td><b>Alamat</b></td>
<td>:</td>
<td>
<p class="user">' . $du["alamat"] . '</p>
</td>
</tr>

<tr>
<td><b>Kontak</b></td>
<td>:</td>
<td>
<p class="user">' . $du["hp"] . '</p>
</td>
</tr>';
}

$html .= '
</table>

<p class="insick">Berdasarkan hasil diagnosa <b>Sistem Pakar Diagnosa Gangguan Kepribadian Menggunakan Metode <i>Certainty Factor</i></b> yang dinilai dari gejala dan tingkat keyakinan yang dipilih oleh pasien, mendapatkan hasil persentase tertinggi sebesar <b><i>' . $persentase . '%</i></b> yang merujuk pada jenis gangguan :</p>

<h2 class="sick">' . $idp . " : " . $penyakit . '</h2>

<h4 class="tgej">D A T A   G E J A L A</h4>

<table class="dgej" border="1" cellpadding="10" cellspacing="0">
		<tr>
			<th>No</th>
			<th>ID</th>
			<th>Gejala yang dialami</th>			
			<th>Keyakinan</th>						
		</tr>';
$i = 1;
foreach ($diag as $row) {

	$html .= '<tr>
	<td>' . $i++ . '</td>
	<td>' . $row["iddgej"] . '</td>
	<td class="t2">' . $row["dgej"] . '</td>
	<td class="t2">' . $row["dfrasa"] . '</td>	
	</tr>';
}

$html .= '</table>

<h4 class="tsol">S O L U S I</h4>

<table class="dgej" border="1" cellpadding="10" cellspacing="0">
		<tr>
			<th>No</th>
			<th>ID</th>
			<th>Solusi yang tepat</th>
						
		</tr>';
$i = 1;
foreach ($sol as $row) {

	$html .= '<tr>
	<td>' . $i++ . '</td>
	<td>' . $row["id_solusi"] . '</td>
	<td class="sol">' . $row["des_solusi"] . '</td>	
	</tr>';
}

$html .= '</table>

</body>

</html>';



$mpdf->WriteHTML($html);


$mpdf->Output('Laporan - ' . $idk . '.pdf', 'D');
