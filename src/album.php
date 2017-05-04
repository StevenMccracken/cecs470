#!/usr/local/php5/bin/php-cgi
<?php include 'config.php';
$conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
$error = mysqli_connect_error();
if ($error != null) {
  $output = "<p>Unable to connect to database</p>" . $error;
  exit($output);
} ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php echo $_GET["album"] . " " . $_GET["year"]; ?></title>
		<link rel="stylesheet" type="text/css" href="project.css">
	</head>
	<p>Student Project - not a commercial site.</p>	
<?php include 'header.php' ?>
	
	<main>
   <h1><?php echo $_GET["album"] . " " . $_GET["year"]; ?></h1>
      <?php 
         global $conn;
         $sql = "SELECT Url FROM Photos WHERE Album = '". $_GET["album"] . "';";
         $result = mysqli_query($conn, $sql);
         if($result=mysqli_query($conn, $sql)) {
            while($rows=mysqli_fetch_assoc($result)) { ?>
               <img class="gallery" src="<?php echo $rows["Url"]; ?>" alt="">
            <?php
            }
         } else { echo "no result<br>";}
         ?>
		
		<div class="clear"></div>
	</main>
	
   <?php include 'footer.php' ?>
	
</html>