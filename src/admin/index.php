#!/usr/local/php5/bin/php-cgi
<?php
	$needDB = true;
	$path = '../';
	$protected = true;
	include '../includes/setup.php';
	include '../includes/header.php';
?>

<main>
<?php echo $_SESSION['auth']; ?>
</main>

<?php include '../includes/footer.php' ?>
