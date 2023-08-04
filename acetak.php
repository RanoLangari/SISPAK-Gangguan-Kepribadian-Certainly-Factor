<?php 

session_start();

if (!isset($_SESSION["level2"])) {
  header("Location: index.php");
  exit;


}


date_default_timezone_set('Asia/Jakarta');

require_once __DIR__ . '/vendor/autoload.php';


require 'functions.php';

$aturan = query("SELECT * FROM taturancf");


$mpdf = new \Mpdf\Mpdf();

$stylesheet = file_get_contents('css/style.css');

$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);


$html='<!DOCTYPE html>
<html>
<head>
	<title>Cetak Aturan</title>
	
</head>
<body>
<table>
<tr>
<td>
<h3>Data Aturan Sistem Pakar Diagnosis Gangguan Kepribadian Menggunakan Metode <i>Certainty Factor</i></h3>
</td>
</tr>
</table>
<hr>';
$html .='<p>Tanggal : '.date("d/m/Y, h:i:s a").'</p> <br><br>
<table border="1" cellpadding="10" cellspacing="0">
		<tr>
			<th>No</th>
			<th>ID</th>
			<th>Gejala</th>
			<th>Gangguan</th>
			<th>Frasa Keyakinan</th>
			<th>Bobot Pakar</th>			
		</tr>';
$i=1;		
foreach($aturan as $row ){

	$html .= '<tr>
	<td>'.$i++.'</td>
	<td>'.$row["id_cf"].'</td>
	<td class="agejala">'.$row["agejala"].'</td>
	<td class="apenyakit">'.$row["apenyakit"].'</td>
	<td>'.$row["frasa"].'</td>
	<td>'.$row["bobotcf"].'</td>
	</tr>';
}

$html .='</table>
</body>
</html>';



$mpdf->WriteHTML($html);


$mpdf->Output('Data_Aturan.pdf','D');


 ?>