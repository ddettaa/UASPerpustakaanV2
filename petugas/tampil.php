<?php
ob_start();
session_start();
error_reporting(E_ALL);

if($_SESSION['role'] !== 'petugas') {
	echo "Silahkan Kembali";
	header("Location: ../index.php?page=home"); 
	exit;
}

else {
	include "header.php";
	include "konten.php";
	include "footer.php";
}
?>