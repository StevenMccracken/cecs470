#!/usr/local/php5/bin/php-cgi
<?php
	$needDB = true;
	$path = '../../';
	$protected = true;
	include '../../include/setup.php';

	if (!empty($_GET['id'])) {
		$id = mysqli_real_escape_string($conn, $_GET['id']);
		$sql = "DELETE FROM Packages WHERE id='$id';";
		mysqli_query($conn, $sql);
		header('location: ../index.php');
		exit();
	}
?>
