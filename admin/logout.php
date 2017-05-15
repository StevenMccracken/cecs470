#!/usr/local/php5/bin/php-cgi
<?php
	$path = '../';
	$protected = true;
	include '../include/setup.php';
	$_SESSION['auth'] = false;
	header('location:' . $path . 'admin/login.php');
	exit(0);
?>
