<?php
require_once "newlayout.php";

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data Group</title>
  
	    <!-- Bootstrap core CSS -->
    <link href="dashboard.css" rel="stylesheet">
    <link href="../assets/style.css" rel="stylesheet">

</head>

<body>
	<div id="show"></div>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			setInterval(function () {
				$('#show').load('data-grouping-ext.php')
			}, 100);
		});
	</script>
</body>
</html>