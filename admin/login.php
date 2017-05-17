#!/usr/local/php5/bin/php-cgi
<?php
	$needDB = true;
	$path = '../';
	include '../include/setup.php';
	include '../include/models.php';

	$error = '';

	// form is submitted
	if (isset($_POST) and !empty($_POST)) {
		// check if
		if (empty($_POST['username']) || empty($_POST['password'])) {
			$error = "Please fill out the form";
		}
		else {
			$password = sha1($_POST['password']);
			$result = getUser($_POST['username']);
			if (!result)
				$error = "Error with the database, please try again later";
			else if (mysqli_num_rows($result) == 0)
				$error = "Wrong credentials";
			else {
				$user = mysqli_fetch_assoc($result);
				if ($user['Password'] != $password)
					$error = "Wrong credentials";
			}
		}

		// no error, login is successful
		if (empty($error)) {
			$_SESSION['auth'] = true; // we are authenticated
			header('location:./index.php'); // redirect to index page
			exit();
		}
	}

	include '../include/header.php';
?>

<main class="admin">
	<h1>Admin panel</h1>
  <form method="post" action="">
		<p>Login to access admin features</p>
		<?php if (!empty($error)) echo "<div class=\"error\">$error</div>"; ?>
		<label for="username">Username</label>
		<input type="text" id ="username" name="username" placeholder="username" required />
		<label for="password">Password</label>
		<input type="password" id="password" name="password" placeholder="password" required />
		<input type="submit" value="Log in" />
  </form>
	<div class="clear"></div>
</main>

<?php include '../include/footer.php' ?>
