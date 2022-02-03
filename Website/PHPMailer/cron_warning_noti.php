<?php 
include("connection.php");
?>

<?php							
	$query = mysqli_query($db, "SELECT * FROM max_min_mail ORDER by ID DESC LIMIT 1");									//	max and min for each sensor for the mailing system to evaluate
	$sensor = mysqli_fetch_row($query);
	$curr_tds_max = $sensor[1];
	$curr_tds_min = $sensor[2];
	
	$curr_temp_max = $sensor[3];
	$curr_temp_min = $sensor[4];
	
	$curr_ec_max = $sensor[5];
	$curr_ec_min = $sensor[6];
	
	$curr_ph_max = $sensor[7];
	$curr_ph_min = $sensor[8];
?>

<?php 																													// get the last value of tds, temp, ec, ph
	$query	 = mysqli_query($db, "SELECT * FROM watervalue ORDER by id DESC LIMIT 1");
	$data	 = mysqli_fetch_row($query);
	$tds	 = $data[1]; echo "tds : ". $tds;
	$temp	 = $data[2]; echo "temp : ".$temp;
	$ec		 = $data[3]; echo "ec : ".$ec;
	$ph		 = $data[4]; echo "ph : ".$ph;
?>

<?php 	
	$query = mysqli_query($db, "SELECT state FROM noti_state ORDER by id DESC LIMIT 1");									// get notification state boolean
	$noti_state = mysqli_fetch_row($query);
	$noti_state = $noti_state[0];
	
	// check last time mail have been send
	$query = mysqli_query($db, "SELECT exp_mail FROM last_mail ORDER by id DESC LIMIT 1");
	$lastmail = mysqli_fetch_row($query);
	$lastmail = strtotime($lastmail[0]); // convert to string format
	echo "<br>Last mail send at ".$lastmail. " (String format)";

	$curmail = date("Y-m-d H:i:s");
	$curmail = strtotime($curmail); 	// convert to string format
	echo " ".$curmail;
?>

<?php 
	$query	 = mysqli_query($db, "SELECT Time FROM watervalue ORDER by id DESC LIMIT 1");
	$latest_input_time = mysqli_fetch_row($query);
	$latest_input_time = $latest_input_time[0];
	$latest_input_time = strtotime($latest_input_time);
	
	$curr_time = date("Y-m-d H:i:s");
	echo " Current Time".$curr_time;
	$curr_time = strtotime($curr_time);
	
	$gap = $curr_time - $latest_input_time;
	
	echo "<br>The gap between latest input and the current time : " .$gap;
		
?>

<?php 	
	if($noti_state == 1){		
														// run notification if notification state is 'TRUE'
		if(	$gap >= 300 ){ 					 			// gap is in second. 300sec = 5min
			if( $curmail > $lastmail){
				include('sendmail-noinput.php');
				
				$expFormat = mktime(date("H")+1, date("i"), date("s"), date("m") ,date("d"), date("Y"));
				$expmail = date("Y-m-d H:i:s",$expFormat);
				mysqli_query($db,"INSERT INTO `last_mail` (`exp_mail`) VALUES ('".$expmail."');");
			}
			else{
				echo "Process Halted. No input email already been send before";
			}
		}
		
		elseif(	$tds > $curr_tds_max || $tds < $curr_tds_min ){
			if( $curmail > $lastmail){
				include('sendmail-tds.php');
				
				$expFormat = mktime(date("H")+1, date("i"), date("s"), date("m") ,date("d"), date("Y"));
				$expmail = date("Y-m-d H:i:s",$expFormat);
				mysqli_query($db,"INSERT INTO `last_mail` (`exp_mail`) VALUES ('".$expmail."');");
			}
			else{
				echo "Process Halted. TDS email already been send before";
			}
		}
		
		elseif(	$temp > $curr_temp_max ||  $temp < $curr_temp_min ){
			if( $curmail > $lastmail){
				include('sendmail-temp.php');
				
				$expFormat = mktime(date("H")+1, date("i"), date("s"), date("m") ,date("d"), date("Y"));
				$expmail = date("Y-m-d H:i:s",$expFormat);
				mysqli_query($db,"INSERT INTO `last_mail` (`exp_mail`) VALUES ('".$expmail."');");
			}
			else{
				echo "Process Halted. Temperature email already been send before";
			}
		}
		
		elseif(	$ec > $curr_ec_max ||  $ec < $curr_ec_min ){
			if( $curmail > $lastmail){
				include('sendmail-ec.php');
				
				$expFormat = mktime(date("H")+1, date("i"), date("s"), date("m") ,date("d"), date("Y"));
				$expmail = date("Y-m-d H:i:s",$expFormat);
				mysqli_query($db,"INSERT INTO `last_mail` (`exp_mail`) VALUES ('".$expmail."');");
			}
			else{
				echo "Process Halted. EC email already been send before";
			}
		}
		
		elseif(	$ph > $curr_ph_max ||  $ph < $curr_ph_min ){
			if( $curmail > $lastmail){
				include('sendmail-ph.php');
				
				$expFormat = mktime(date("H")+1, date("i"), date("s"), date("m") ,date("d"), date("Y"));
				$expmail = date("Y-m-d H:i:s",$expFormat);
				mysqli_query($db,"INSERT INTO `last_mail` (`exp_mail`) VALUES ('".$expmail."');");
			}
			else{
				echo "Process Halted. pH email already been send before";
			}
		}
		
		else{
			echo 'Nothing unusual detected';
		}
	}else{
		echo '<br>Notification setting is turned OFF';
	}
		
	
?>