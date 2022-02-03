<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} 
include('connection.php');	
?>

<?php
$x_tanggal1  = mysqli_query($db, 'SELECT Time FROM ( SELECT * FROM watervalue ORDER BY id DESC LIMIT 20) Var1 ORDER BY id ASC');

$x_tanggal2  = mysqli_query($db, 'SELECT Time FROM ( SELECT * FROM watervalue ORDER BY id DESC LIMIT 20) Var1 ORDER BY id ASC');
$x_tanggal3  = mysqli_query($db, 'SELECT Time FROM ( SELECT * FROM watervalue ORDER BY id DESC LIMIT 20) Var1 ORDER BY id ASC');
$x_tanggal4  = mysqli_query($db, 'SELECT Time FROM ( SELECT * FROM watervalue ORDER BY id DESC LIMIT 20) Var1 ORDER BY id ASC');
		
$y_tds   = mysqli_query($db, 'SELECT tds FROM ( SELECT * FROM watervalue ORDER BY id DESC LIMIT 20) Var1 ORDER BY ID ASC');
$y_temp   = mysqli_query($db, 'SELECT waterTemp FROM ( SELECT * FROM watervalue ORDER BY id DESC LIMIT 20) Var1 ORDER BY ID ASC');
$y_ec   = mysqli_query($db, 'SELECT EC FROM ( SELECT * FROM watervalue ORDER BY id DESC LIMIT 20) Var1 ORDER BY ID ASC'); 
$y_ph   = mysqli_query($db, 'SELECT pH FROM ( SELECT * FROM watervalue ORDER BY id DESC LIMIT 20) Var1 ORDER BY ID ASC');   

$result = mysqli_query($db, "SELECT count(*) as total from watervalue");
$data=mysqli_fetch_assoc($result);
//echo $data['total'];

	// obtain tds state
	$query = mysqli_query($db, "SELECT tds_state FROM sensor_state ORDER by id DESC LIMIT 1");
	$tds = mysqli_fetch_row($query);
	$tds_state = $tds[0];

	// obtain temp state
	$query = mysqli_query($db, "SELECT temp_state FROM sensor_state ORDER by id DESC LIMIT 1");
	$temp = mysqli_fetch_row($query);
	$temp_state = $temp[0];

	// obtain ec state
	$query = mysqli_query($db, "SELECT ec_state FROM sensor_state ORDER by id DESC LIMIT 1");
	$ec = mysqli_fetch_row($query);
	$ec_state = $ec[0];

	// obtain ph state
	$query = mysqli_query($db, "SELECT ph_state FROM sensor_state ORDER by id DESC LIMIT 1");
	$ph = mysqli_fetch_row($query);
	$ph_state = $ph[0];

	$active 	= $tds_state + $temp_state + $ec_state + $ph_state;
	$deactive = 4 - $active;
?>




<div class="hold-transition sidebar-mini layout-fixed">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data</h1>
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
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $data['total']; ?></h3>
            
                <p>Total Input</p>
              </div>
              <div class="icon">
                <i class="ion ion-loop"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $active ?><sup style="font-size: 20px"></sup></h3>
				
			<p>Activated Sensors</p>
              </div>
              <div class="icon">
                <i class="ion ion-checkmark-circled"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $deactive ?></h3>

                <p>Deactived Sensors</p>
              </div>
              <div class="icon">
                <i class="ion ion-minus-circled"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>0</h3>



                <p>New Information</p>
              </div>
              <div class="icon">
                <i class="ion ion-information-circled"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
<!------------------------------------------------------------------------------------------------------------------------------------------->		

	<!-- Main row -->
	<div class="card">
		<div class="card-header border-transparent">
			<h3 class="card-title">Latest Input from sensors</h3>

		</div>

		<div class="card-body p-0">
			<div class="table-responsive">
				<table class="table m-0">
					<thead>
						<tr>
							<th>Time</th>
							<th>TDS (ppm)</th>
							<th>Temperature (°C)</th>
							<th>Electric Conductivity (μS/cm)</th>
							<th>pH</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$sqlAdmin = mysqli_query($db, "SELECT Time,tds,waterTemp,EC,pH FROM watervalue ORDER BY id DESC LIMIT 0,20");
						while($data=mysqli_fetch_array($sqlAdmin))
						{
						echo "<tr >
						<td>$data[Time]</center></td> 
						<td>$data[tds]</td>
						<td>$data[waterTemp]</td>
						<td>$data[EC]</td>
						<td>$data[pH]</td>
						</tr>";
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
			  </div>
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
</div>

