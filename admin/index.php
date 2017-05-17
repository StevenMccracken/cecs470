#!/usr/local/php5/bin/php-cgi
<?php
	$needDB = true;
	$path = '../';
	$protected = true;
	include '../include/setup.php';
	include '../include/models.php';

	$services = getServices();
	$packages = getPackages();

	include '../include/header.php';
?>

<main class="admin-index">
	<h1>Admin panel</h1>
	<h2>Services</h2>
	<a class="button" href="service/edit.php">Create service</a>
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
						<td><?php echo htmlspecialchars($service['Type']); ?></td>
						<td><?php echo htmlspecialchars($service['Description']); ?></td>
						<td><img src="<?php echo $service['ThumbnailUrl']; ?>" alt="Service thumbnail"/></td>
						<td>
							<a href="service/edit.php?id=<?php echo $service['ID']; ?>">Edit</a>
							<a href="service/delete.php?id=<?php echo $service['ID']; ?>">Delete</a>
						</td>
					</tr>
				<?php } ?>
	  </tbody>
	</table>

	<hr /><br /><br />
	<h2>Packages</h2>
	<a class="button" href="package/edit.php">Create package</a>
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
					<td><?php echo htmlspecialchars($package['Type']); ?></td>
					<td><?php echo htmlspecialchars($package['Name']); ?></td>
					<td><?php echo htmlspecialchars($package['Price']); ?>$</td>
					<td><?php echo htmlspecialchars($package['Locations']); ?></td>
					<td><?php echo htmlspecialchars($package['Outfits']); ?></td>
					<td><?php echo htmlspecialchars($package['Duration']); ?></td>
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
