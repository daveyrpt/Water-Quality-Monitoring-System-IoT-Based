<?php
require_once "newlayout.php";

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<?php
// obtain state
$query = mysqli_query($db, "SELECT state FROM scheduler_state ORDER by id DESC LIMIT 1");
$state = mysqli_fetch_row($query);
$state = $state[0];
if($state == '1'){
	$state = "checked";
}
elseif($state == '0'){
	$state = "";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>
  
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
            <h1 class="m-0">Set Scheduler</h1>
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

              <div class="card-body p-0">

                <table class="table table-striped">
				
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Schedule</th>
                      <th></th>
                      <th style="width: 40px">&nbsp&nbsp State</th>
                    </tr>
                  </thead>
				  
                  <tbody>
                    <tr>
                      <td>1.</td>
                      <td>Run once every hour</td>
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
                      <td></td>
                      <td></td>
					  <td></td>
                      <td>
						<div class="bootstrap">
						
							<input type="submit" name="insert" id="action" class="btn btn-success swalDefaultSuccess" value="Proceed" />
						
						</div>
                      </td>
                    </tr>
					
                  </tbody>
				  
                </table>
				</form>
              </div>
              <!-- /.card-body -->
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
$(document).ready(function(){
 
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
    url:"scheduler-db.php",
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
	});
</script>