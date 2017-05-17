<?php

function getServices() {
	global $conn;
	$sql = "SELECT * FROM Services;";
	return mysqli_query($conn, $sql);
}

function getPackages() {
	global $conn;
	$sql = "SELECT * FROM Packages LEFT JOIN Services ON Packages.Service = Services.ID";
	return mysqli_query($conn, $sql);
}

function getRequests() {
	global $conn;
	$sql = "SELECT * FROM Requests
		LEFT JOIN Packages ON Requests.package = Packages.ID
		LEFT JOIN Services ON Packages.Service = Services.ID";
	return mysqli_query($conn, $sql);
}

function getUser($username) {
	global $conn;

	$safe_username = mysqli_real_escape_string($conn, $username);
	$query = "SELECT * FROM Users WHERE Username = '". $safe_username . "';";
	return mysqli_query($conn, $query);
}

?>
