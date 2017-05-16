#!/usr/local/php5/bin/php-cgi
<?php
	$needDB = true;
	$path = '../../';
	$protected = true;
	include '../../include/setup.php';

	// this page is either create or update a service
	// if there is 'id' in url, it's a edit
	$create = empty($_GET['id']);
	$verb = $create ? 'Create' : 'Edit';
	$id = $create ? 0 : mysqli_real_escape_string($conn, $_GET['id']);
	$type = '';
	$description = '';
	$url = '';
	$error = '';

	if (isset($_POST) and !empty($_POST)) {
		// form is submited
		if (empty($_POST['type']) || empty($_POST['description']) || empty($_POST['url'])) {
			$error = "Please fill out the form";
		}
		else {
			$type = mysqli_real_escape_string($conn, $_POST['type']);
			$url = mysqli_real_escape_string($conn, $_POST['url']);
			$description = mysqli_real_escape_string($conn, $_POST['description']);
			if ($create)
				$sql = "INSERT INTO Services (Type, ThumbnailUrl, Description) VALUES ('$type', '$url', '$description')";
			else
				$sql = "UPDATE Services SET Type='$type', ThumbnailUrl='$url', Description='$description' WHERE id='$id';";
			// redirect to home admin
			if (!mysqli_query($conn, $sql))
				$error = "Error database: " . mysqli_error($conn);
			else {
				header('location: ../index.php');
				exit();
			}
		}
	}
	else {
		if (!$create) {
			$sql = "SELECT * FROM Services WHERE id='$id';";
			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) == 0)
				$error = "Can't find service";
			else {
				$service = mysqli_fetch_assoc($result);
				$type = $service['Type'];
				$url = $service['ThumbnailUrl'];
				$description = $service['Description'];
			}
		}
	}

	include '../../include/header.php';
?>
<main class="admin">
	<h1><?php echo $verb;?> Service</h1>
	<form method="post" action="">
		<?php if (!empty($error)) echo "<div class=\"error\">$error</div>"; ?>

		<label for="type">Type</label>
		<input type="text" id="type" name="type" placeholder="type" value="<?php echo $type;?>" required />

		<label for="url">Thumbnail URL</label>
		<input type="text" id="url" name="url" placeholder="url" value="<?php echo $url;?>" required />

			<label for="description">Description</label>
			<textarea id="description" name="description" placeholder="Description" rows="5" required><?php echo $description;?></textarea>

		<input type="submit" value="<?php echo $verb; ?>" />
	</form>
</main>
<?php
	include '../../include/footer.php';
?>
