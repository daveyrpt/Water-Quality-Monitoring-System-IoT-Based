<?php
require_once "newlayout.php";

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<?php
if(isset($_GET['sdate']) || isset($_GET['edate']))
{ 
	$sdate = $_GET['sdate'];
	$edate = $_GET['edate'];
	$sqlAdmin = mysqli_query($db, "SELECT id,tds,waterTemp,EC,pH,Time FROM watervalue WHERE date BETWEEN ' $sdate ' AND ' $edate ' ORDER BY id DESC LIMIT 0,100000");
}
else
{
	$sqlAdmin = mysqli_query($db, "SELECT id,tds,waterTemp,EC,pH,Time FROM watervalue ORDER BY id DESC LIMIT 0,20");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log</title>
  
	    <!-- Bootstrap core CSS -->
    <link href="dashboard.css" rel="stylesheet">
    <link href="../assets/style.css" rel="stylesheet">

</head>


<body class="hold-transition sidebar-mini layout-fixed">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Log</h1>
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
	  
<!------------------------------------------------------------------------------------------------------------------------------------------->		

        <!-- Main row -->
		<div class="bootstrap">
      

	
	<div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title"><center>Water Quality Value</h3>
    </div>
    <div class="panel-body">
	
      <form class="form-horizontal" method="GET">  
        <div class="form-group">
          <label class="col-md-2">From Time</label>   
          <div class="col-md-2">
            <input type="date" name="sdate" class="form-control" value="<?php echo $sdate; ?>" required>
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-2">Until Time</label>   
          <div class="col-md-2">
            <input type="date" name="edate" class="form-control" value="<?php echo $edate; ?>" required>
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-2"></label>   
          <div class="col-md-8">
            <input type="submit" class="btn btn-primary" value="Search">
            <a href='log.php' class='btn btn-primary' >Reset</a>
			<button class='btn btn-warning btn-sm' onclick="window.print()">Print</button>
          </div>

        </div>
      </form>

      <table class="table table-bordered table-striped">
        <thead>
          <tr >
            <th class='text-center'>ID</th>
            <th class='text-center'>Time</th>
            <th class='text-center'>TDS (ppm)</th>
            <th class='text-center'>Temperature (°C)</th> 
			<th class='text-center'>Electric Conductivity (μS/cm)</th>   
			<th class='text-center'>pH</th>   			
          </tr>
        </thead>
        <tbody>
          <?php
            
          while($data=mysqli_fetch_array($sqlAdmin))
          {
            echo "<tr >
            <td><center>$data[id]</td>
            <td><center>$data[Time]</center></td> 
            <td><center>$data[tds]</td>
            <td><center>$data[waterTemp]</td> 
			<td><center>$data[EC]</td>   
			<td><center>$data[pH]</td>   			
            </tr>";
          }
          ?>
        </tbody>
      </table> 
	  
    </div>
  </div>

  
  
  
  


  </div> <!-- end of bootstrap -->
  
  
  
  
  
  
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
