<?php 

session_start();

if (!isset($_SESSION["level2"])) {
  header("Location: index.php");
  exit;


}


date_default_timezone_set('Asia/Jakarta');

require_once __DIR__ . '/vendor/autoload.php';


require 'functions.php';

$gejala = query("SELECT * FROM tgejala");


$mpdf = new \Mpdf\Mpdf();

$stylesheet = file_get_contents('css/style.css');

$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);


$html='<!DOCTYPE html>
<html>
<head>
	<title>Daftar Gejala</title>
	
</head>
<body>
<table>
<tr>
<td>
<h3>Data Gejala Sistem Pakar Diagnosis Gangguan Kepribadian Menggunakan Metode <i>Certainty Factor</i>
</td>
</tr>
</table>
<hr>';
$html .='<p>Tanggal : '.date("d/m/Y, h:i:s a").'</p> <br> <br>
<table border="1" cellpadding="10" cellspacing="0">
		<tr>
			<th>No</th>
			<th>ID</th>
			<th>Gejala</th>			
		</tr>';
$i=1;		
foreach($gejala as $row ){

	$html .= '<tr>
	<td>'.$i++.'</td>
	<td>'.$row["id_gejala"].'</td>
	<td class="nama">'.$row["n_gejala"].'</td>
	</tr>';
}

$html .='</table>
</body>
</html>';



$mpdf->WriteHTML($html);


$mpdf->Output('Daftar_Gejala.pdf','D');


 ?>