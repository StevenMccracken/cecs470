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
		<title>PHILIP NGUYEN</title>
		<link rel="stylesheet" type="text/css" href="project.css">
	</head>
	<p>Student Project - not a commercial site.</p>	
<?php include 'header.php' ?>

	
	<main>
      <?php 
         global $conn;
         $headers = ["PORTRAITS", "EVENT PHOTOGRAPHY", "GRADUATION SHOOTS"];
         $sql = "SELECT * FROM Albums;";
         $result = mysqli_query($conn, $sql);
         $i = 0; //counter for header logic
         if($result=mysqli_query($conn, $sql)) {
            while($rows=mysqli_fetch_assoc($result)) {
               if($i%3 == 0) {
                   echo "<h1>".$headers[$i/3]."</h1>";
               } ?>
               <a href="album.php?Album=<?php echo $rows["Name"]; ?>&Year=<?php echo $rows["Year"] ?> ">
                  <img class="gallery" src="<?php echo $rows["CoverUrl"]; ?>" alt="<?php echo $rows["Name"] . " " . $rows["Year"]; ?>">
               </a>
            <?php
               $i++;
            }
            mysqli_free_result($result);
         } else { echo "no result<br>";}
         mysqli_close($conn);
         ?>
		
		<div class="clear"></div>
	</main>
	
   <?php include 'footer.php' ?>
	
</html>