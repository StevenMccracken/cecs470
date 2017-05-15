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
	      <th>Thumbnail</th>
				<th>Actions</th>
	    </tr>
	  </thead>
	  <tbody>
				<?php while($service = mysqli_fetch_assoc($services)) { ?>
					<tr>
						<td><?php echo $service['Type']; ?></td>
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
	      <th>Duration</th>
	    </tr>
	  </thead>
	  <tbody>
	    <tr>
	      <td>Body content 1</td>
	      <td>Body content 2</td>
	    </tr>
	  </tbody>
	</table>
</main>

<?php include '../include/footer.php' ?>
