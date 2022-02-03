<?php
require_once "newlayout.php";

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<?php
	// obtain tds state
	$query = mysqli_query($db, "SELECT tds_state FROM sensor_state ORDER by id DESC LIMIT 1");
	$tds = mysqli_fetch_row($query);
	$tds_state = $tds[0];
	if($tds_state == '1'){
		$cur_tds_state = "class = 'btn btn-block btn-success'";
		$cur_tds_state1 = "On";
	}
	elseif($tds_state == '0'){
		$cur_tds_state = "class = 'btn btn-block btn-danger'";
		$cur_tds_state1 = "Off";
	}
	// obtain temp state
	$query = mysqli_query($db, "SELECT temp_state FROM sensor_state ORDER by id DESC LIMIT 1");
	$temp = mysqli_fetch_row($query);
	$temp_state = $temp[0];
	if($temp_state == '1'){
		$cur_temp_state = "class = 'btn btn-block btn-success'";
		$cur_temp_state1 = "On";
	}
	elseif($temp_state == '0'){
		$cur_temp_state = "class = 'btn btn-block btn-danger'";
		$cur_temp_state1 = "Off";
	}
	// obtain ec state
	$query = mysqli_query($db, "SELECT ec_state FROM sensor_state ORDER by id DESC LIMIT 1");
	$ec = mysqli_fetch_row($query);
	$ec_state = $ec[0];
	if($ec_state == '1'){
		$cur_ec_state = "class = 'btn btn-block btn-success'";
		$cur_ec_state1 = "On";
	}
	elseif($ec_state == '0'){
		$cur_ec_state = "class = 'btn btn-block btn-danger'";
		$cur_ec_state1 = "Off";
	}
	// obtain ph state
	$query = mysqli_query($db, "SELECT ph_state FROM sensor_state ORDER by id DESC LIMIT 1");
	$ph = mysqli_fetch_row($query);
	$ph_state = $ph[0];
	if($ph_state == '1'){
		$cur_ph_state = "class = 'btn btn-block btn-success'";
		$cur_ph_state1 = "On";
	}
	elseif($ph_state == '0'){
		$cur_ph_state = "class = 'btn btn-block btn-danger'";
		$cur_ph_state1 = "Off";
	}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Control Sensor</title>
  
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
            <h1 class="m-0">Control Sensor</h1>
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
						<th>Sensor Type</th>
						<th>&nbsp&nbsp    Option</th>
						<th style="width: 10px">&nbsp Status</th>
						<th style="width: 10px"></th>
                    </tr>
                  </thead>
				  
                  <tbody>
                    <tr>
                      <td>1.</td>
                      <td>Total Dissolve Solid</td>
                      
                      <td>
						<div class="bootstrap">
						<div class="form-group">
							<div class="checkbox">
								<input type="checkbox" name="gender" id="gender" checked />
							</div>
						</div>
						<input type="hidden" name="hidden_gender" id="hidden_gender" value="1" />
						</div>
						</td>
					<td><button type="button" <?php echo $cur_tds_state ?>><?php echo $cur_tds_state1 ?></button></td>
					<td></td>
                    </tr>
					
                    <tr>
                      <td>2.</td>
                      <td>Temperature</td>
                      <td>
						<div class="bootstrap">
						<div class="form-group">
							<div class="checkbox">
								<input type="checkbox" name="gender1" id="gender1" checked />
							</div>
						</div>
						<input type="hidden" name="hidden_gender1" id="hidden_gender1" value="1" />
						</div>
                      </td>
					  </td>
					<td><button type="button" <?php echo $cur_temp_state ?>><?php echo $cur_temp_state1 ?></button></td>
					<td></td>
                    </tr>
					
                    <tr>
                      <td>3.</td>
                      <td>Electric Conductivity</td>
                      <td>
						<div class="bootstrap">
						<div class="form-group">
							<div class="checkbox">
								<input type="checkbox" name="gender2" id="gender2" checked />
							</div>
						</div>
						<input type="hidden" name="hidden_gender2" id="hidden_gender2" value="1" />
						</div>
                      </td>
					<td><button type="button" <?php echo $cur_ec_state ?>><?php echo $cur_ec_state1 ?></button></td>
					<td></td>
                    </tr>
					
                    <tr>
                      <td>4.</td>
                      <td>pH</td>
                      <td>
						<div class="bootstrap">
						<div class="form-group">
							<div class="checkbox">
								<input type="checkbox" name="gender3" id="gender3" checked />
							</div>
						</div>
						<input type="hidden" name="hidden_gender3" id="hidden_gender3" value="1" />
						</div>
                      </td>
						<td><button type="button" <?php echo $cur_ph_state ?>><?php echo $cur_ph_state1 ?></button></td>
						<td></td>
                    </tr>
                  </tbody>
				  
				<table>
					<tr>                
						<div class="bootstrap">						
							<input type="submit" onClick="refreshPage()" name="insert" id="action" class="btn btn-block bg-gradient-primary	 btn-sm" value="Change" />
						</div>
                    </tr>
				</table>				
				  
				  
                </table>
				</div>
				</form>
              
              <!-- /.card-body -->
            </div>
       
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <!-- /.control-sidebar -->

<!-- ./wrapper -->
</body>
</html>

<script>

function refreshPage(){
	setTimeout(function(){
		window.location.reload();
	}, 2000); 
} 


$(document).ready(function(){
//////////////////////////////////////////////
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
/////////////////////////////////////////////
 $('#gender1').bootstrapToggle({
  on: 'Enable',
  off: 'Disable',
  onstyle: 'success',
  offstyle: 'danger'
 });

 $('#gender1').change(function(){
  if($(this).prop('checked'))
  {
   $('#hidden_gender1').val('1');
  }
  else
  {
   $('#hidden_gender1').val('0');
  }
 });
/////////////////////////////////////////////
 $('#gender2').bootstrapToggle({
  on: 'Enable',
  off: 'Disable',
  onstyle: 'success',
  offstyle: 'danger'
 });

 $('#gender2').change(function(){
  if($(this).prop('checked'))
  {
   $('#hidden_gender2').val('1');
  }
  else
  {
   $('#hidden_gender2').val('0');
  }
 });
/////////////////////////////////////////////
$('#gender3').bootstrapToggle({
  on: 'Enable',
  off: 'Disable',
  onstyle: 'success',
  offstyle: 'danger'
 });

 $('#gender3').change(function(){
  if($(this).prop('checked'))
  {
   $('#hidden_gender3').val('1');
  }
  else
  {
   $('#hidden_gender3').val('0');
  }
 });
/////////////////////////////////////////////




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
    url:"sensor-state-db.php",
    method:"POST",
    data:form_data,
    success:function(data){
     if(data == 'done')
     {
      $('#insert_data')[0].reset();
      $('#gender').bootstrapToggle('0');
	  $('#gender1').bootstrapToggle('1');
	  $('#gender2').bootstrapToggle('1');
	  $('#gender3').bootstrapToggle('1');
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

    $('.btn-sm').click(function() {
      Toast.fire({
        icon: 'success',
        title: ' Changes has been made'
      })
    });
	});
</script>