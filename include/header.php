<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php if (isset($title)) echo $title; else echo "PHILIP NGUYEN"; ?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo $path; ?>reset.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $path; ?>project.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $path; ?>admin.css">
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
	</head>
  <body>
  	<p>Student Project - not a commercial site.</p>

    <header>
     <img class="logo" src="<?php echo $path; ?>logo.jpg" alt="Philip Nguyen Photography">
        <nav>
           <a href="<?php echo $path; ?>index.php">HOME</a>
           <a href="<?php echo $path; ?>services.php">SERVICES</a>
           <a href="<?php echo $path; ?>book.php">BOOK</a>
           <a href="<?php echo $path; ?>aboutphilip.php">ABOUT</a>
					 <?php if ($isLog) { ?>
						 <a href="<?php echo $path; ?>admin/index.php">ADMIN</a>
						 <a href="<?php echo $path; ?>admin/logout.php">LOGOUT</a>
					 <?php } ?>
        </nav>
     <div class="clear"></div>
   </header>
