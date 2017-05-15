<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php if (isset($title)) echo $title; else echo "TITLE"; ?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo $path; ?>project.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $path; ?>admin.css">
	</head>
  <body>
  	<p>Student Project - not a commercial site.</p>

    <header>
     <div class="pageName">PHILIP NGUYEN/LOGO</div>
        <nav>
           <a href="<?php echo $path; ?>index.php">HOME</a>
           <a href="<?php echo $path; ?>services.php">SERVICES</a>
           <a href="<?php echo $path; ?>book.php">BOOK</a>
           <a href="<?php echo $path; ?>aboutphilip.php">ABOUT</a>
        </nav>
     <div class="clear"></div>
   </header>
