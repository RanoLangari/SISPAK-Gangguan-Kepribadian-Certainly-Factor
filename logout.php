<?php 

session_start();
	
	if (!isset($_SESSION['username'])) {
		  header("Location: home.html");
		  exit;	  
	}

$_SESSION = [];
session_unset();
session_destroy();

header("Location: home.html");
exit;

 ?>