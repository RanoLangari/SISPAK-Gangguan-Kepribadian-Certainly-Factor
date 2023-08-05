<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

$conn = mysqli_connect("localhost", "root", "", "gangguan_kepribadian");

function query($query)
{

	global $conn;

	$result = mysqli_query($conn, $query);

	$rows = [];

	while ($row = mysqli_fetch_assoc($result)) {

		$rows[] = $row;
	}

	return $rows;
}

function registrasi($data)
{

	global $conn;

	$iduser = htmlspecialchars($data["iduser"]);
	$rusername = strtolower(stripslashes($data["pusername"]));
	$rpass	= mysqli_real_escape_string($conn, $data["ppas"]);
	$kpass	= mysqli_real_escape_string($conn, $data["kpas"]);
	$rnama	= htmlspecialchars($data["pnama"]);
	$rjk	= htmlspecialchars($data["pjk"]);
	$rprodi	= htmlspecialchars($data["pprodi"]);
	$ralamat = htmlspecialchars($data["palamat"]);
	$rtlp = htmlspecialchars($data["ptlp"]);
	$rulevel = htmlspecialchars($data["clevel"]);


	//Cek konfirmasi Password

	if ($rpass !== $kpass) {

		echo "<script>
				alert('Konfirmasi Password Salah!');
			</script>
		";

		return false;
	}


	//cek username sudah ada atau belum

	$result = mysqli_query($conn, "SELECT username FROM tuser WHERE username ='$rusername'");

	if (mysqli_fetch_assoc($result)) {

		echo "<script>
				alert('username sudah ada silahkan pakai username lain!');
			</script>
		";

		return false;
	}

	//enkripsi password

	$rpass = password_hash($rpass, PASSWORD_DEFAULT);


	//query insert data

	$query = "INSERT INTO tuser 
				VALUES
				('$iduser','$rusername', '$rpass','$rnama', '$rjk', '$rprodi	', '$ralamat','$rtlp','$rulevel')";


	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function ubah($data)
{

	global $conn;

	$iduser = htmlspecialchars($data["id_u_user"]);
	$rusername = strtolower(stripslashes($data["u_username"]));
	$rpass	= mysqli_real_escape_string($conn, $data["u_pas"]);
	$kpass	= mysqli_real_escape_string($conn, $data["u_kpas"]);
	$rnama	= htmlspecialchars($data["u_nama"]);
	$rjk	= htmlspecialchars($data["u_jk"]);
	$rprodi	= htmlspecialchars($data["u_prodi"]);
	$ralamat = htmlspecialchars($data["u_alamat"]);
	$rtlp = htmlspecialchars($data["u_tlp"]);


	//cek konfirmasi password

	if ($rpass !== $kpass) {

		echo "<script>
				alert('Konfirmasi Ubah Password Salah!');
			</script>
		";

		return false;
	}


	//cek username sudah ada atau belum

	$result = mysqli_query($conn, "SELECT username FROM tuser WHERE username ='$rusername' AND
		id_tuser !='$iduser'");

	if (mysqli_fetch_assoc($result)) {

		echo "<script>
				alert('username sudah ada silahkan gunakan username lain!');
			</script>
		";

		return false;
	}


	$rpass = password_hash($rpass, PASSWORD_DEFAULT);


	$query = "UPDATE tuser SET					
			username='$rusername',
			password='$rpass',
			nama='$rnama',
			jenis_kelamin='$rjk',
			prodi='$rprodi',
			alamat='$ralamat',
			hp='$rtlp'
			WHERE id_tuser = '$iduser'";



	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}



function SimpanG($data)
{

	global $conn;

	$idG = htmlspecialchars($data["idG"]);
	$nG = htmlspecialchars(strtolower(stripslashes($data["ngejala"])));


	//cek nama gejala sudah ada atau belum

	$result = mysqli_query($conn, "SELECT n_gejala FROM tgejala WHERE n_gejala ='$nG'");

	if (mysqli_fetch_assoc($result)) {

		echo "<script>
				alert('Gejala sudah ada!');
			</script>
		";

		return false;
	}


	//query insert data

	$query = "INSERT INTO tgejala 
	VALUES ('$idG','$nG')";


	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function hapusG($data)
{
	global $conn;
	$id = htmlspecialchars(strtolower(stripslashes($data['idG'])));
	$result = mysqli_query($conn, "DELETE FROM tgejala WHERE id_gejala ='$id'");
	if ($result) {
		return true;
	} else {
		return false;
	}
}

function ubahg($data)
{

	global $conn;

	$idG = htmlspecialchars($data["uidG"]);
	$nG = htmlspecialchars(strtolower(stripslashes($data["ungejala"])));


	//cek username sudah ada atau belum

	$result = mysqli_query($conn, "SELECT n_gejala FROM tgejala WHERE n_gejala ='$nG' AND
		id_gejala !='$idG'");

	if (mysqli_fetch_assoc($result)) {

		echo "<script>
				alert('Gejala sudah ada!');
			</script>
		";

		return false;
	}

	$query = "UPDATE tgejala SET					
			n_gejala='$nG'
			WHERE id_gejala = '$idG'";



	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}



function SimpanP($data)
{

	global $conn;

	$idP = htmlspecialchars($data["idP"]);
	$nP = htmlspecialchars(strtolower(stripslashes($data["npenyakit"])));
	$solusi = htmlspecialchars(strtolower(stripslashes($data["tsolusi"])));


	//cek nama gejala sudah ada atau belum

	$result = mysqli_query($conn, "SELECT n_penyakit FROM tpenyakit WHERE n_penyakit ='$nP'");

	if (mysqli_fetch_assoc($result)) {

		echo "<script>
				alert('Gangguan sudah ada!');
			</script>
		";

		return false;
	}


	//query insert data

	$query = "INSERT INTO tpenyakit 
	VALUES ('$idP','$nP', '$solusi')";


	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function hapusPenyakit($data)
{
	global $conn;
	$id_ = htmlspecialchars(strtolower(stripslashes($data['uidP'])));
	$result = mysqli_query($conn, "DELETE FROM tpenyakit WHERE id_penyakit ='$id_'");
	if ($result) {
		return true;
	} else {
		return false;
	}
}
function ubahP($data)
{

	global $conn;

	$idP = htmlspecialchars($data["uidP"]);
	$nP = htmlspecialchars(strtolower(stripslashes($data["unpenyakit"])));
	$solusi = htmlspecialchars(strtolower(stripslashes($data["solusi"])));

	//cek gangguan sudah ada atau belum

	$result = mysqli_query($conn, "SELECT n_penyakit FROM tpenyakit WHERE n_penyakit ='$nP' AND
		id_penyakit !='$idP'");

	if (mysqli_fetch_assoc($result)) {

		echo "<script>
				alert('Gangguan sudah ada!');
			</script>
		";

		return false;
	}

	$query = "UPDATE tpenyakit SET					
			n_penyakit='$nP',solusi='$solusi'
			WHERE id_penyakit = '$idP'";



	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}



function SimpanS($data)
{

	global $conn;

	$idS = htmlspecialchars($data["idS"]);
	$spenyakit = htmlspecialchars(strtolower(stripslashes($data["spenyakit"])));
	$dp = htmlspecialchars(strtolower(stripslashes($data["des_penanganan"])));


	//cek solusi sudah ada atau belum

	$result = mysqli_query($conn, "SELECT n_spenyakit FROM solusi WHERE n_spenyakit ='$spenyakit'");

	if (mysqli_fetch_assoc($result)) {

		echo "<script>
				alert('Data Solusi Sudah Ada!');
			</script>
		";

		return false;
	}


	//ambil ID penyakit	

	$data = mysqli_query($conn, "SELECT id_penyakit FROM tpenyakit WHERE n_penyakit = '$spenyakit'");

	$id = mysqli_fetch_assoc($data);

	$idp = $id["id_penyakit"];

	// var_dump($idp);
	// exit();



	//query insert data

	$query = "INSERT INTO solusi 
	VALUES ('$idS','$idp','$spenyakit','$dp')";


	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function ubahS($data)
{

	global $conn;

	$ids = htmlspecialchars($data["uids"]);
	$nP = htmlspecialchars(strtolower(stripslashes($data["uspenyakit"])));
	$dp = htmlspecialchars(strtolower(stripslashes($data["udes_penanganan"])));


	//cek solusi sudah ada atau belum

	$result = mysqli_query($conn, "SELECT n_spenyakit FROM solusi WHERE n_spenyakit ='$nP' AND
		id_solusi !='$ids'");

	if (mysqli_fetch_assoc($result)) {

		echo "<script>
				alert('Data Solusi Sudah Ada!');
			</script>
		";

		return false;
	}

	$query = "UPDATE solusi SET					
			des_solusi='$dp'
			WHERE id_solusi = '$ids'";



	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}



function SimpanA($data)
{

	global $conn;

	$ida = htmlspecialchars($data["ida"]);
	$angejala = htmlspecialchars(strtolower(stripslashes($data["angejala"])));
	$anpenyakit = htmlspecialchars(strtolower(stripslashes($data["anpenyakit"])));
	$bkey = htmlspecialchars(strtolower(stripslashes($data["bkey"])));

	switch ($bkey) {

		case 'selalu':

			$bobot = 1;
			break;

		case 'sering':

			$bobot = 0.8;
			break;

		case 'kadang':

			$bobot = 0.6;
			break;

		case 'jarang':

			$bobot = 0.4;
			break;

		case 'tidak tahu':

			$bobot = 0.2;
			break;

		case 'tidak pernah':

			$bobot = 0;
			break;

		default:

			echo "<script>
				alert('Bobot Aturan Tidak ada!');
			</script>
		";

			return false;

			break;
	}


	//ambil ID penyakit	

	$data = mysqli_query($conn, "SELECT id_penyakit FROM tpenyakit WHERE n_penyakit = '$anpenyakit'");

	$id = mysqli_fetch_assoc($data);

	$idp = $id["id_penyakit"];


	//ambil ID gejala	

	$data = mysqli_query($conn, "SELECT id_gejala FROM tgejala WHERE n_gejala = '$angejala'");

	$idgg = mysqli_fetch_assoc($data);

	$idg = $idgg["id_gejala"];


	// var_dump($idp);
	// exit();




	//cek data penanganan sudah ada atau belum

	$result = mysqli_query($conn, "SELECT id_agejala, id_apenyakit FROM taturancf WHERE id_agejala ='$idg' AND id_apenyakit = '$idp'");

	if (mysqli_fetch_assoc($result)) {

		echo "<script>
				alert('Data Aturan Sudah Ada!');
			</script>
		";

		return false;
	}





	//query insert data

	$query = "INSERT INTO taturancf 
	VALUES ('$ida','$idg','$angejala','$idp','$anpenyakit','$bkey','$bobot')";


	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function ubahA($data)
{

	global $conn;

	$ida = htmlspecialchars($data["uida"]);
	$angejala = htmlspecialchars(strtolower(stripslashes($data["uangejala"])));
	$anpenyakit = htmlspecialchars(strtolower(stripslashes($data["uanpenyakit"])));
	$bkey = htmlspecialchars(strtolower(stripslashes($data["ubkeyy"])));

	switch ($bkey) {

		case 'selalu':

			$bobot = 1;
			break;

		case 'sering':

			$bobot = 0.8;
			break;

		case 'kadang':

			$bobot = 0.6;
			break;

		case 'jarang':

			$bobot = 0.4;
			break;

		case 'tidak tahu':

			$bobot = 0.2;
			break;

		case 'tidak pernah':

			$bobot = 0;
			break;

		default:

			echo "<script>
				alert('Bobot Aturan Tidak ada!');

			</script>
		";

			return false;

			break;
	}


	//ambil ID penyakit	

	$data = mysqli_query($conn, "SELECT id_penyakit FROM tpenyakit WHERE n_penyakit = '$anpenyakit'");

	$id = mysqli_fetch_assoc($data);

	$idp = $id["id_penyakit"];


	//ambil ID gejala	

	$data = mysqli_query($conn, "SELECT id_gejala FROM tgejala WHERE n_gejala = '$angejala'");

	$idgg = mysqli_fetch_assoc($data);

	$idg = $idgg["id_gejala"];


	// var_dump($idp);
	// exit();




	//cek data penanganan sudah ada atau belum

	$result = mysqli_query($conn, "SELECT id_agejala, id_apenyakit FROM taturancf WHERE id_agejala ='$idg' AND id_apenyakit = '$idp' AND id_cf != '$ida'");

	if (mysqli_fetch_assoc($result)) {

		echo "<script>
				alert('Data Aturan Sudah Ada!');
			</script>
		";

		return false;
	}





	$query = "UPDATE taturancf SET					
			id_agejala ='$idg',
			agejala = '$angejala',
			id_apenyakit ='$idp',
			apenyakit = '$anpenyakit',
			frasa ='$bkey',
			bobotcf = '$bobot'
			WHERE id_cf = '$ida'";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function hapusA($id)
{

	global $conn;

	mysqli_query($conn, "DELETE FROM taturancf WHERE id_cf = '$id'");


	return mysqli_affected_rows($conn);
}

function tmbgejala($data)
{


	global $conn;

	$un = htmlspecialchars($data["un"]);
	$idd = htmlspecialchars($data["idd"]);
	$idg = htmlspecialchars(stripslashes($data["dgejala"]));
	$ptk = htmlspecialchars(strtolower(stripslashes($data["ptk"])));


	switch ($ptk) {

		case 'selalu':

			$bobot = 1;
			break;

		case 'sering':

			$bobot = 0.8;
			break;

		case 'kadang':

			$bobot = 0.6;
			break;

		case 'jarang':

			$bobot = 0.4;
			break;

		case 'tidak tahu':

			$bobot = 0.2;
			break;

		case 'tidak pernah':

			$bobot = 0;
			break;

		default:

			echo "<script>
				alert('Bobot Aturan Tidak ada!');
				document.location = 'igejala.php';
			</script>
		";

			return false;

			break;
	}


	//ambil ID user	

	$data = mysqli_query($conn, "SELECT id_tuser FROM tuser WHERE username = '$un'");

	$iduu = mysqli_fetch_assoc($data);

	$idu = $iduu["id_tuser"];

	//ambil data gejala

	$data = mysqli_query($conn, "SELECT n_gejala FROM tgejala WHERE id_gejala = '$idg'");

	$dgg = mysqli_fetch_assoc($data);

	$dg = $dgg["n_gejala"];

	//cek data gejala sudah ada atau belum

	$result = mysqli_query($conn, "SELECT iddgej FROM diagnosis WHERE iddgej ='$idg' " . "AND idduser = '$idu'");

	if (mysqli_fetch_assoc($result)) {

		// query update data
		$query = "UPDATE diagnosis SET					
			dfrasa ='$ptk',
			dbot = '$bobot'
			WHERE iddgej = '$idg'" . "AND idduser = '$idu'";
		mysqli_query($conn, $query);
		return 1;
	}

	//query insert data

	$query = "INSERT INTO diagnosis 
	VALUES ('$idd','$idu','$idg','$dg','$bobot','$ptk')";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function hapusdg($id)
{

	global $conn;

	mysqli_query($conn, "DELETE FROM diagnosis WHERE id_d = '$id'");


	return mysqli_affected_rows($conn);
}

function cekdiag($user)
{

	global $conn;

	//ambil ID user	

	$data = mysqli_query($conn, "SELECT id_tuser FROM tuser WHERE username = '$user'");

	$iduu = mysqli_fetch_assoc($data);

	$idu = $iduu["id_tuser"];


	//cek data diagnosa sudah ada atau belum

	$result = mysqli_query($conn, "SELECT idduser FROM diagnosis WHERE idduser ='$idu' ");

	if (mysqli_fetch_assoc($result)) {

		return true;
	}
}

function batal($user)
{

	global $conn;

	//ambil ID user	

	$data = mysqli_query($conn, "SELECT id_tuser FROM tuser WHERE username = '$user'");

	$iduu = mysqli_fetch_assoc($data);

	$idu = $iduu["id_tuser"];

	mysqli_query($conn, "DELETE FROM diagnosis WHERE idduser = '$idu'");

	return mysqli_affected_rows($conn);
}

function selesai($data)
{

	global $conn;

	$idk = htmlspecialchars($data["idk"]);
	$idku = htmlspecialchars($data["idku"]);
	$idkp = htmlspecialchars($data["idkp"]);
	$pre = htmlspecialchars($data["pre"]);
	$date = htmlspecialchars($data["date"]);

	//ambil ID user	

	$datau = mysqli_query($conn, "SELECT id_tuser FROM tuser WHERE username = '$idku'");

	$iduu = mysqli_fetch_assoc($datau);

	$idu = $iduu["id_tuser"];


	//ambil ID Penyakit	

	$datap = mysqli_query($conn, "SELECT id_penyakit FROM tpenyakit WHERE n_penyakit = '$idkp'");

	$idpp = mysqli_fetch_assoc($datap);

	$idp = $idpp["id_penyakit"];

	//ambil ID Solusi	

	$datas = mysqli_query($conn, "SELECT id_solusi FROM solusi WHERE id_spenyakit = '$idp'");

	$idss = mysqli_fetch_assoc($datas);

	$ids = $idss["id_solusi"];


	//query insert data

	$query = "INSERT INTO konsultasi 
	VALUES ('$idk','$idu','$idp','$idkp','$pre','$ids','$date')";

	mysqli_query($conn, $query);

	//hapus data diagnosa

	mysqli_query($conn, "DELETE FROM diagnosis WHERE idduser = '$idu'");

	return mysqli_affected_rows($conn);
}


function importDataViaExcel($data)
{
	global $conn;
	// id user

	$query = "SELECT max(id_tuser) as max_code FROM tuser";

	$hasil = mysqli_query($conn, $query);

	$data = mysqli_fetch_assoc($hasil);

	$id = $data['max_code'];

	$urutan = (int)substr($id, 1, 3);

	$urutan;

	$huruf = 'U';
	$id_user = $huruf . sprintf("%02s", $urutan);
	$fileName = $_FILES['excel']['tmp_name'];
	$spreadsheet = IOFactory::load($fileName);
	$sheetData = $spreadsheet->getActiveSheet()->toArray();
	for ($i = 1; $i < count($sheetData); $i++) {
		$id_user++;
		$user = $sheetData[$i]['0'];
		$pass = $sheetData[$i]['1'];
		$passEnkrip = password_hash($pass, PASSWORD_DEFAULT);
		$nama = $sheetData[$i]['2'];
		$jk = $sheetData[$i]['3'];
		$prodi = $sheetData[$i]['4'];
		$alamat = $sheetData[$i]['5'];
		$hp = $sheetData[$i]['6'];
		$level = $sheetData[$i]['7'];
		$query = "INSERT INTO tuser VALUES ('$id_user','$user','$passEnkrip','$nama','$jk','$prodi','$alamat','$hp','$level')";
		mysqli_query($conn, $query);
	}
	return mysqli_affected_rows($conn);
}
