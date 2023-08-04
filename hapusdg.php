<?php 

session_start();

if (!isset($_SESSION['level1'])) {
  header("Location: index.php");
  exit;
  
}

require 'functions.php';












 ?>