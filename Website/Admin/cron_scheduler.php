<?php 
include("connection.php");
?>

<?php 
	
	
	// check scheduler_state if enable or disable
	$query = mysqli_query($db, "SELECT state FROM scheduler_state ORDER by id DESC LIMIT 1"); 
	$scheduler_state = mysqli_fetch_row($query);
	$scheduler_state = $scheduler_state[0];
		
	$curmark1 = date("Y-m-d H:i:s");
	echo "Current Date:".$curmark1."</br>";
	$curtime = strtotime($curmark1); 	// convert to string format
	echo "Current Date in String:".$curtime."</br>";

	$query = mysqli_query($db, "SELECT exp_mark FROM last_mark ORDER by id DESC LIMIT 1"); 
	$last_mark = mysqli_fetch_row($query);
	echo "Last Mark Date:".$last_mark[0]."</br>";
	$mark_time_after_hour = strtotime($last_mark[0]);
	echo "Last Mark Date in string:".$mark_time_after_hour."</br>";
	
	if(	$scheduler_state == 1){

		if( $curtime >= $mark_time_after_hour ){
			$query = mysqli_query($db, "SELECT id FROM watervalue ORDER by id DESC LIMIT 1");
			$mark = mysqli_fetch_row($query);
			$mark = $mark[0];
			$query = mysqli_query($db, "UPDATE watervalue SET mark = '1' WHERE id = '".$mark."' ");
			$query = mysqli_query($db, "SELECT Time FROM watervalue WHERE mark = '1' ORDER by id DESC LIMIT 1");
			$mark_time = mysqli_fetch_row($query);
			echo " Time where mark is 1: ".$mark_time[0]."</br>";
			$mark_time = strtotime($mark_time[0]);
			echo " Time where mark is 1 in string: ".$mark_time."</br>";
			$mark_time_after_hour = $mark_time + ( 01 * 60 * 60);
			echo " Time where mark is 1 and in 1 hour in string: ".$mark_time_after_hour."</br>";
			$mark_time_after_hour = date("Y-m-d H:i:s",$mark_time_after_hour);
			echo " Time where mark is 1 and in 1 hour: ".$mark_time_after_hour."</br>";
			
			$query = mysqli_query($db,"INSERT INTO `last_mark` (`exp_mark`) VALUES ('".$mark_time_after_hour."');");
		}
		elseif( $curtime < $mark_time_after_hour ){
			
			
			$query = mysqli_query($db, "DELETE FROM watervalue 
						WHERE Time BETWEEN '".$curmark1."' AND '".$last_mark[0]."' AND mark IS NULL");
			echo "deleting";
		}
					

	}

?>