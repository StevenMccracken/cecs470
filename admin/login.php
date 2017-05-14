#!/usr/local/php5/bin/php-cgi
<?php
	$needDB = true;
	$path = '../';
	include '../include/setup.php';

	$error = '';

	if (isset($_POST) and !empty($_POST)) {

		if (empty($_POST['username']) || empty($_POST['password'])) {
			$error = "Please fill out the form";
		}
		else {
			$username = mysqli_real_escape_string($conn, $_POST['username']);
			$password = $_POST['password'];

			$query = "SELECT * FROM Users WHERE Username = '". $username . "';";
			$result = mysqli_query($conn, $query);

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

		if (empty($error)) {
			$_SESSION['auth'] = true;
			header('location:./index.php');
			exit();
		}
	}

	include '../include/header.php';
?>

<main>
	<h1>Admin panel</h1>
  <form method="post" action="">
		<?php echo $error; ?>
		<label for="username">Username</label>
		<input type="text" id ="username" name="username" placeholder="username" required />
		<label for="password">Password</label>
		<input type="password" id="password" name="password" placeholder="password" required />
		<input type="submit" />
  </form>
	<div class="clear"></div>
</main>

<?php include '../include/footer.php' ?>
