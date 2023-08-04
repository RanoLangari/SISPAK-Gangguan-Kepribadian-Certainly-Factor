<?php 

session_start();

require 'functions.php';

$lusername = $_POST["lusername"];
$lpass	= $_POST["lpass"];

$level1  = "client";
$level2 = "admin";

$result = mysqli_query($conn, "SELECT * FROM tuser WHERE username = '$lusername'");

	//cek username
if (mysqli_num_rows($result)===1) {

		//cek password

	$row = mysqli_fetch_assoc($result);

	if(password_verify($lpass, $row["password"]) && $level1 == $row["level"]){
		$_SESSION['username'] = $lusername;
		$_SESSION["nama"] = $row['nama'];
		$_SESSION['level1'] = true;
		$_SESSION["id"] = $row["id_tuser"];

		$_SESSION["pas"] = $lpass;

		echo "
		<script>
		alert('Login berhasil!');
		document.location = 'index.php';
		</script>";

	}

	elseif (password_verify($lpass, $row["password"]) && $level2 == $row["level"]) {

		$_SESSION['username'] = $lusername;
		$_SESSION['level2'] = true;

		$_SESSION["id"] = $row["id_tuser"];

		$_SESSION["pas"] = $lpass;

		echo "
		<script>
		alert('Login berhasil!');
		document.location = 'admin/index.php';
		</script>";

	}

	else{		

		header("Location: index.php?x=fail");
	}

}

else{

	header("Location: index.php?x=fail");
}

?>

<script type='text/javascript'>
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
</script>