<?php 
include("connection.php");
?>

<?php 
	date_default_timezone_set("Singapore");
		
	$query = mysqli_query($db, "SELECT tds FROM watervalue ORDER by id DESC LIMIT 1");
	$data = mysqli_fetch_row($query);
	$latest_tds = $data[0]; // 0 indicate first row
	echo $latest_tds." ";

	$query = mysqli_query($db, "SELECT tds_state FROM sensor_state ORDER by id DESC LIMIT 1");
	$data = mysqli_fetch_row($query);
	$tds_state = $data[0];
	echo $tds_state." ";
	
	$query = mysqli_query($db, "SELECT temp_state FROM sensor_state ORDER by id DESC LIMIT 1");
	$data = mysqli_fetch_row($query);
	$temp_state = $data[0];
	echo $temp_state." ";
	
	$query = mysqli_query($db, "SELECT ec_state FROM sensor_state ORDER by id DESC LIMIT 1");
	$data = mysqli_fetch_row($query);
	$ec_state = $data[0];
	echo $ec_state." ";
	
	$query = mysqli_query($db, "SELECT ph_state FROM sensor_state ORDER by id DESC LIMIT 1");
	$data = mysqli_fetch_row($query);
	$ph_state = $data[0];
	echo $ph_state." ";
	
	$query = mysqli_query($db, "SELECT time FROM sensor_state ORDER by id DESC LIMIT 1");
	$data = mysqli_fetch_row($query);
	$tds_time = $data[0];
	echo $tds_time." ";
	
	$currenttime = date("Y-m-d H:i:s");
	echo $currenttime;
	
	if($tds_state == 0)
	{
		$sql = "UPDATE watervalue set tds = null WHERE Time BETWEEN '".$tds_time."' AND '".$currenttime."'";
		if (mysqli_query($db, $sql)) {
		echo "Record stopped successfully ";
		} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($db);
		}	
	}
	
	if($temp_state == 0)
	{
		$sql = "UPDATE watervalue set waterTemp = null WHERE Time BETWEEN '".$tds_time."' AND '".$currenttime."'";
		if (mysqli_query($db, $sql)) {
		echo "Record stopped successfully ";
		} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($db);
		}	
	}
	
	if($ec_state == 0)
	{
		$sql = "UPDATE watervalue set EC = null WHERE Time BETWEEN '".$tds_time."' AND '".$currenttime."'";
		if (mysqli_query($db, $sql)) {
		echo "Record stopped successfully ";
		} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($db);
		}	
	}
	
	if($ph_state == 0)
	{
		$sql = "UPDATE watervalue set pH = null WHERE Time BETWEEN '".$tds_time."' AND '".$currenttime."'";
		if (mysqli_query($db, $sql)) {
		echo "Record stopped successfully ";
		} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($db);
		}	
	}

	
?>