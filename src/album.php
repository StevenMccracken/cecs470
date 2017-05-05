#!/usr/local/php5/bin/php-cgi
<?php
	$needDB = true;
	include 'includes/setup.php';
 	include 'includes/header.php';
?>

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

<?php include 'includes/footer.php' ?>
