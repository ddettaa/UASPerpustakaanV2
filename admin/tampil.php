<?php
ob_start();
session_start();
error_reporting(E_ALL);
// Verify if user has admin role
if($_SESSION['role'] !== 'admin') {
	echo "Silahkan Kembali";
	header("Location: ../index.php?page=home"); 
	exit;
}
// If user is logged in and has admin role
else {
	include "header.php";
	include "konten.php";
	include "footer.php";
}
?>