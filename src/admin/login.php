#!/usr/local/php5/bin/php-cgi
<?php
	$needDB = true;
	$path = '../';
	include '../includes/setup.php';

	if (isset($_POST) and !empty($_POST)) {
		if ($_POST['username'] == 'dodo') {
			$_SESSION['auth'] = true;
			header('location:./index.php');
			exit();
		}
	}

	include '../includes/header.php';
?>

<main>
  <form method="post" action="">
    Login page
		<input type="text" name="username" placeholder="username" />
		<input type="submit" />
  </form>
	<div class="clear"></div>
</main>

<?php include '../includes/footer.php' ?>
