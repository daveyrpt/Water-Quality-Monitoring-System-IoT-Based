<?php
require_once "newlayout.php";

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<?php						//	checking if the mailing system state if enable or disable 
	$query = mysqli_query($db, "SELECT state FROM noti_state ORDER by id DESC LIMIT 1");
	$state = mysqli_fetch_row($query);
	$state = $state[0];
	if($state == '1'){
		$state = "checked";
	}
	elseif($state == '0'){
		$state = "";
	}
?>

<?php							//	max and min for each sensor for the mailing system to evaluate
	$query = mysqli_query($db, "SELECT * FROM max_min_mail ORDER by ID DESC LIMIT 1");
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

<?php							//	send max and min for each sensor
$tds_max = $tds_min = $temp_max = $temp_min = "";
$ec_max = $ec_min = $ph_max = $ph_min = "";

$tds_max_err = $tds_min_err = $temp_max_err = $temp_min_err = "";
$ec_max_err = $ec_min_err = $ph_max_err = $ph_min_err = "";

// Processing form data when form is submitted
if (isset($_POST['insertsetting'])){
	
		// Validate tds_max
    if(trim($_POST["tds_max"]) != '0' && empty(trim($_POST["tds_max"]))){
        $tds_max = $curr_tds_max;    
    } elseif(!preg_match('/^[0-9_.]+$/', trim($_POST["tds_max"]))){
        $tds_max_err = "Value can only set in number";
    } else{
		$tds_max = trim($_POST["tds_max"]);
    }
	
			// Validate tds_min
    if(trim($_POST["tds_max"]) != '0' && empty(trim($_POST["tds_min"]))){
        $tds_min = $curr_tds_min;
    } elseif(!preg_match('/^[0-9_.]+$/', trim($_POST["tds_min"]))){
        $tds_min_err = "Value can only set in number";
    } else{
        $tds_min = trim($_POST["tds_min"]);
    }
	
			// Validate temp_max
    if(trim($_POST["tds_max"]) != '0' && empty(trim($_POST["temp_max"]))){
        $temp_max = $curr_temp_max;    
    } elseif(!preg_match('/^[0-9_.]+$/', trim($_POST["temp_max"]))){
        $temp_max_err = "Value can only set in number";
    } else{
        $temp_max = trim($_POST["temp_max"]);
    }
	
		// Validate temp_min
    if(trim($_POST["tds_max"]) != '0' && empty(trim($_POST["temp_min"]))){
        $temp_min = $curr_temp_min;     
    } elseif(!preg_match('/^[0-9_.]+$/', trim($_POST["temp_min"]))){
        $temp_min_err = "Value can only set in number";
    } else{
        $temp_min = trim($_POST["temp_min"]);
    }
	
		// Validate ec_max
    if(trim($_POST["tds_max"]) != '0' && empty(trim($_POST["ec_max"]))){
        $ec_max = $curr_ec_max;     
    } elseif(!preg_match('/^[0-9_.]+$/', trim($_POST["ec_max"]))){
        $ec_max_err = "Value can only set in number";
    } else{
        $ec_max = trim($_POST["ec_max"]);
    }
	
		// Validate ec_min
    if(trim($_POST["tds_max"]) != '0' && empty(trim($_POST["ec_min"]))){
        $ec_min = $curr_ec_min;     
    } elseif(!preg_match('/^[0-9_.]+$/', trim($_POST["ec_min"]))){
        $ec_min_err = "Value can only set in number";
    } else{
        $ec_min = trim($_POST["ec_min"]);
    }
	
		// Validate ph_max
    if(trim($_POST["tds_max"]) != '0' && empty(trim($_POST["ph_max"]))){
        $ph_max = $curr_ph_max;     
    } elseif(!preg_match('/^[0-9_.]+$/', trim($_POST["ph_max"]))){
        $ph_max_err = "Value can only set in number";
    } else{
        $ph_max = trim($_POST["ph_max"]);
    }
	
		// Validate ph_min
    if(trim($_POST["tds_max"]) != '0' && empty(trim($_POST["ph_min"]))){
        $ph_min = $curr_ph_min;     
    } elseif(!preg_match('/^[0-9_.]+$/', trim($_POST["ph_min"]))){
        $ph_min_err = "Value can only set in number";
    } else{
        $ph_min = trim($_POST["ph_min"]);
    }

	
	    // Check input errors before inserting in database
    if(empty($tds_max_err) && empty($tds_min_err) && empty($temp_max_err) && empty($temp_min_err) && empty($ec_max_err) && empty($ec_min_err) && empty($ph_max_err) && empty($ph_min_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO max_min_mail (max_tds, min_tds, max_temp, min_temp, max_ec, min_ec, max_ph, min_ph) VALUES (?,?,?,?,?,?,?,?)";
		
         
        if($stmt = $db->prepare($sql)){
            // Bind variables to the prepared statement as parameters
             $stmt->bind_param("dddddddd", $param_tds_max, $param_tds_min, $param_temp_max, $param_temp_min, $param_ec_max, $param_ec_min, $param_ph_max, $param_ph_min);
            
            // Set parameters
            $param_tds_max = $tds_max;
			$param_tds_min = $tds_min;
            $param_temp_max = $temp_max;
			$param_temp_min = $temp_min;
			$param_ec_max = $ec_max;
			$param_ec_min = $ec_min;
			$param_ph_max = $ph_max;
			$param_ph_min = $ph_min;
			
            // Attempt to execute the prepared statement
            if($stmt->execute()){
               echo("<script>location.href = 'warning-noti.php';</script>");
                //echo "Success";
            } else{
                //echo "Oops! Something went wrong. Please try again later.";				
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Close connection
    $db->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Notify Me</title>
  
	    <!-- Bootstrap core CSS -->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

	<link rel="stylesheet" href="../welcome4a.css" />
	<link rel="stylesheet" href="../welcome4b.css" />

</head>


<body class="hold-transition sidebar-mini layout-fixed">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Notify Me</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Welcome <?php echo htmlspecialchars($_SESSION["username"]); ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
	  
																							<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

																							<div class="card">

																							<!-- /.card-header -->
																							<div class="card-body p-0">

																							<table class="table table-striped" >

																							<thead>
																							<tr>
																							<th style="width: 10px">ID.</th>
																							<th> Set Limit/Threshold for Each Sensor</th>
																							<th> Current Max </th>
																							<th>New Max </th>
																							<th> Current Min </th>
																							<th>New Min </th>																							
																							</tr>
																							</thead>

																							<tbody>
																							<tr  >
																							<td>1.</td>
																							<td>Total Dissolved Solid</td>
																							<td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $curr_tds_max ?></td>
																							<!-- START - tds max -->
																							<td>
																							<div class="input-group mb-3">
																								<input type="text" name="tds_max" class="form-control <?php echo (!empty($tds_max_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $tds_max; ?>" placeholder="">
																								<div class="input-group-append">
																									
																										<span class="invalid-feedback"><?php echo $tds_max_err; ?></span>
																									
																								</div>
																							</div>
																							</td>
																							<!-- END - tds max -->
																							<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $curr_tds_min ?></td>
																							<!-- START - tds min -->
																							<td>
																							<div class="input-group mb-3">
																								<input type="text" name="tds_min" class="form-control <?php echo (!empty($tds_min_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $tds_min; ?>" placeholder="">
																								<div class="input-group-append">
																									
																										<span class="invalid-feedback"><?php echo $tds_min_err; ?></span>
																									
																								</div>
																							</div>
																							</td>
																							<!-- END - tds min -->
																							</tr>
																							
																							<tr>
																							<td>2.</td>
																							<td>Temperature</td>
																							<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $curr_temp_max ?></td>
																							<!-- START - temp max -->
																							<td>
																							<div class="input-group mb-3">
																								<input type="text" name="temp_max" class="form-control <?php echo (!empty($temp_max_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $temp_max; ?>" placeholder="">
																								<div class="input-group-append">
																									
																										<span class="invalid-feedback"><?php echo $temp_max_err; ?></span>
																									
																								</div>
																							</div>
																							</td>
																							<!-- END - temp max -->
																							<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $curr_temp_min ?></td>
																							<!-- START - temp min -->
																							<td>
																							<div class="input-group mb-3">
																								<input type="text" name="temp_min" class="form-control <?php echo (!empty($temp_min_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $temp_min; ?>" placeholder="">
																								<div class="input-group-append">
																									
																										<span class="invalid-feedback"><?php echo $temp_min_err; ?></span>
																									
																								</div>
																							</div>
																							</td>
																							<!-- END - temp min -->
																							</tr>
																							
																							<tr>
																							<td>3.</td>
																							<td>Electric Conductivity</td>
																							<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $curr_ec_max ?></td>
																							<!-- START - ec max -->
																							<td>
																							<div class="input-group mb-3">
																								<input type="text" name="ec_max" class="form-control <?php echo (!empty($ec_max_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ec_max; ?>" placeholder="">
																								<div class="input-group-append">
																									
																										<span class="invalid-feedback"><?php echo $ec_max_err; ?></span>
																									
																								</div>
																							</div>
																							</td>
																							<!-- END - ec max -->
																							<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $curr_ec_min ?></td>
																							<!-- START - ec min -->
																							<td>
																							<div class="input-group mb-3">
																								<input type="text" name="ec_min" class="form-control <?php echo (!empty($ec_min_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ec_min; ?>" placeholder="">
																								<div class="input-group-append">
																									
																										<span class="invalid-feedback"><?php echo $ec_main_err; ?></span>
																									
																								</div>
																							</div>
																							</td>
																							<!-- END - ec min -->
																							</tr>
																							
																							<tr>
																							<td>4.</td>
																							<td>pH</td>
																							<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $curr_ph_max ?></td>
																							<!-- START - ph max -->
																							<td>
																							<div class="input-group mb-3">
																								<input type="text" name="ph_max" class="form-control <?php echo (!empty($ph_max_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ph_max; ?>" placeholder="">
																								<div class="input-group-append">
																									
																										<span class="invalid-feedback"><?php echo $ph_max_err; ?></span>
																									
																								</div>
																							</div>
																							</td>
																							<!-- END - ph max -->
																							<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $curr_ph_min ?></td>
																							<!-- START - ph min -->
																							<td>
																							<div class="input-group mb-3">
																								<input type="text" name="ph_min" class="form-control <?php echo (!empty($ph_min_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ph_min; ?>" placeholder="">
																								<div class="input-group-append">
																								
																										<span class="invalid-feedback"><?php echo $ph_min_err; ?></span>
																									
																								</div>
																							</div>
																							</td>
																							<!-- END - ph min -->
																							</tr>
																							

																							</tbody>
																							
																							<table>
																							<tr>
																							<div class="bootstrap">
																												
																							<input type="submit" name="insertsetting" id="actionsetting" class="btn btn-block bg-gradient-primary	 btn-sm" value="Change" />
																							
																							</div>
																							</tr>
																							</table>	
																		
																							</table>
																							</div>
																							</div>
																							</form>
																							
																							
					<form method="post" id="insert_data">
					<div class="form-group">
					<label></label>
					<input type="hidden" name="name" id="name" class="form-control" />
					</div>
					<div class="card">

					<!-- /.card-header -->
					<div class="card-body p-0">

					<table class="table table-striped">

					<thead>
					<tr>
					<th style="width: 10px">ID.</th>
					<th>Platform</th>
					<th></th>
					<th style="width: 40px">&nbsp&nbsp State</th>
					</tr>
					</thead>

					<tbody>
					<tr>
					<td>1.</td>
					<td>Email</td>
					<td></td>
					<td>
					<div class="bootstrap">
					<div class="form-group">
					<div class="checkbox">
					<input type="checkbox" name="gender" id="gender" <?php echo $state ?> />
					</div>
					</div>
					<input type="hidden" name="hidden_gender" id="hidden_gender" value="1" />
					</div>
					</td>
					</tr>
					
					<tr>
					<td>2.</td>
					<td>Telegram</td>
					<td></td>
					<td><i>Coming Soon!</i></td>
					</tr>
					
					<tr>
					<td>3.</td>
					<td>SMS</td>
					<td></td>
					<td><i>Coming Soon!</i></td>
					</tr>
					
					<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>
					<div class="bootstrap">
					<input type="submit" onClick="refreshPageTimer()" name="insert" id="action" class="btn btn-success swalDefaultSuccess" value="Proceed" />

					</div>
					</td>
					</tr>

					</tbody>

					</table>

					</div>
					<!-- /.card-body -->
					</div>
					</form>																					

  
  
  
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
</body>
</html>

<script>

function refreshPageInstant(){	
		window.location.reload();	
} 

function refreshPageTimer(){
	setTimeout(function(){
		window.location.reload();
	}, 2000); 
} 

$(document).ready(function(){	// Toggle Function - Start
 
 $('#gender').bootstrapToggle({
  on: 'Enable',
  off: 'Disable',
  onstyle: 'success',
  offstyle: 'danger'
 });

 $('#gender').change(function(){
  if($(this).prop('checked'))
  {
   $('#hidden_gender').val('1');
  }
  else
  {
   $('#hidden_gender').val('0');
  }
 });

 $('#insert_data').on('submit', function(event){
  event.preventDefault();
  if($('#name').val() == 'null')
  {
   alert("Please Enter Name");
   return false;
  }
  else
  {
   var form_data = $(this).serialize();
   $.ajax({
    url:"warning-noti-db.php",
    method:"POST",
    data:form_data,
    success:function(data){
     if(data == 'done')
     {
      $('#insert_data')[0].reset();
      $('#gender').bootstrapToggle('');
     }
    }
   });
  }
 });

});

  $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        icon: 'success',
        title: ' Changes has been made'
      })
    });
	});															// Toggle Function - End
</script>