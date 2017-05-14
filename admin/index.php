#!/usr/local/php5/bin/php-cgi
<?php
	$needDB = true;
	$path = '../';
	$protected = true;
	include '../include/setup.php';
	include '../include/header.php';
?>

<main>
	<?php echo $_SESSION['auth']; ?>
</main>

<?php include '../include/footer.php' ?>
