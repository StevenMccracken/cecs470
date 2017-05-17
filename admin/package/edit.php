#!/usr/local/php5/bin/php-cgi
<?php
	$needDB = true;
	$path = '../../';
	$protected = true;
	include '../../include/setup.php';
	include '../../include/models.php';

	$services = getServices();

	// this page is either create or update a service
	// if there is 'id' in url, it's a edit
	$create = empty($_GET['id']);
	$verb = $create ? 'Create' : 'Edit';
	$id = $create ? 0 : mysqli_real_escape_string($conn, $_GET['id']);
	$service = 0;
	$name = '';
	$price = 0;
	$locations = 0;
	$outfits = 0;
	$duration = 0;

	if (isset($_POST) and !empty($_POST)) {
		// form is submited
		if (empty($_POST['service']) || empty($_POST['name']) || empty($_POST['price'])) {
			$error = "Please fill out the required field";
		}
		else {
			$service = intval(mysqli_real_escape_string($conn, $_POST['service']));
			$name = mysqli_real_escape_string($conn, $_POST['name']);
			$price = intval(mysqli_real_escape_string($conn, $_POST['price']));
			$locations = intval(mysqli_real_escape_string($conn, $_POST['locations']));
			$outfits = intval(mysqli_real_escape_string($conn, $_POST['outfits']));
			$duration = intval(mysqli_real_escape_string($conn, $_POST['duration']));

			if ($create)
				$sql = "INSERT INTO Packages (Service, Name, Price, Locations, Outfits, Duration) VALUES ('$service', '$name', '$price', '$locations', '$outfits', '$duration')";
			else
				$sql = "UPDATE Packages SET Service='$service', Name='$name', Price='$price', Locations='$locations', Outfits='$outfits', Duration='$duration' WHERE id='$id';";
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
			$sql = "SELECT * FROM Packages WHERE id='$id';";
			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) == 0)
				$error = "Can't find service";
			else {
				$package = mysqli_fetch_assoc($result);

				$service = $package['Service'];
				$name = $package['Name'];
				$price = $package['Price'];
				$locations = $package['Locations'];
				$outfits = $package['Outfits'];
				$duration = $package['Duration'];
			}
		}
	}

	include '../../include/header.php';
?>
<main class="admin">
	<a href="../index.php">Back to admin panel</a>
	<h1><?php echo $verb;?> Package</h1>
	<form method="post" action="">
		<?php if (!empty($error)) echo "<div class=\"error\">$error</div>"; ?>

		<label for="name">Service</label>
		<select name="service">
		  <option value="0">Select a service</option>
			<?php while($s = mysqli_fetch_assoc($services)) { ?>
				<option value="<?php echo $s['ID']; ?>" <?php if ($s['ID'] == $service) echo 'selected'; ?>><?php echo $s['Type']; ?></option>
			<?php } ?>
		</select>

		<label for="name">Name</label>
		<input type="text" id="name" name="name" placeholder="Name" value="<?php echo $name;?>" required />

		<label for="price">Price</label>
		<input type="number" id="price" name="price" placeholder="Price" value="<?php echo $price;?>" required />

		<label for="locations">Locations</label>
		<input type="number" id="locations" name="locations" placeholder="Locations" value="<?php echo $locations;?>" />

		<label for="outfits">Outfits (number)</label>
		<input type="number" id="outfits" name="outfits" placeholder="Outfits" value="<?php echo $outfits;?>" />

		<label for="duration">Duration (hours)</label>
		<input type="number" id="duration" name="duration" placeholder="Duration" value="<?php echo $duration;?>" />

		<input type="submit" value="<?php echo $verb; ?>" />
	</form>
</main>
<?php
	include '../../include/footer.php';
?>
