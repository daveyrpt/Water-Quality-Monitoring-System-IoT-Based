<?php 
	$servername = "localhost";
	$username  = "root";
	$password = "";
	$dbname = "h2obot";

	$db = mysqli_connect($servername, $username, $password, $dbname);

	if (!$db) {
		die("Connection Failed". mysqli_connect_error());
	}
	
	date_default_timezone_set('Singapore');
 ?>