#!/usr/local/php5/bin/php-cgi
<?php
	$needDB = true;
	$path = '../';
	$protected = true;
	include '../include/setup.php';

	function getServices() {
		global $conn;
		$sql = "SELECT * FROM Services;";
		return mysqli_query($conn, $sql);
	}

	$services = getServices();

	function getPackages() {
		global $conn;
		$sql = "SELECT * FROM Packages LEFT JOIN Services ON Packages.Service = Services.ID";
		return mysqli_query($conn, $sql);
	}

	$packages = getPackages();

	include '../include/header.php';
?>

<main>
	<h1>Admin panel</h1>
	<a href="logout.php">Logout</a>

	<h2>Services</h2>
	<a href="service/edit.php">Create</a>
	<table>
		<thead>
	    <tr>
	      <th>Type</th>
				<th>Description</th>
	      <th>Thumbnail</th>
				<th>Actions</th>
	    </tr>
	  </thead>
	  <tbody>
				<?php while($service = mysqli_fetch_assoc($services)) { ?>
					<tr>
						<td><?php echo $service['Type']; ?></td>
						<td><?php echo $service['Description']; ?></td>
						<td><img src="<?php echo $service['ThumbnailUrl']; ?>" alt="Service thumbnail"/></td>
						<td>
							<a href="service/edit.php?id=<?php echo $service['ID']; ?>">Edit</a>
							<a href="service/delete.php?id=<?php echo $service['ID']; ?>">Delete</a>
						</td>
					</tr>
				<?php } ?>
	  </tbody>
	</table>

	<hr />
	<h2>Packages</h2>
	<table>
	  <thead>
	    <tr>
	      <th>Service Type</th>
	      <th>Name</th>
	      <th>Price</th>
	      <th>Locations</th>
	      <th>Outfits</th>
	      <th>Duration</th>
				<th>Actions</th>
	    </tr>
	  </thead>
	  <tbody>
			<?php while($package = mysqli_fetch_assoc($packages)) { ?>
				<tr>
					<td><?php echo $package['Type']; ?></td>
					<td><?php echo $package['Name']; ?></td>
					<td><?php echo $package['Price']; ?>$</td>
					<td><?php echo $package['Locations']; ?></td>
					<td><?php echo $package['Outfits']; ?></td>
					<td><?php echo $package['Duration']; ?></td>
					<td>
						<a href="package/edit.php?id=<?php echo $package['ID']; ?>">Edit</a>
						<a href="package/delete.php?id=<?php echo $package['ID']; ?>">Delete</a>
					</td>
				</tr>
			<?php } ?>
	  </tbody>
	</table>
</main>

<?php include '../include/footer.php' ?>
