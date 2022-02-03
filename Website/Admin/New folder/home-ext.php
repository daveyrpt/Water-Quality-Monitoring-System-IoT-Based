<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} 
include('connection.php');	
?>

<?php
// graph related
$x_tanggal1  = mysqli_query($db, 'SELECT Time2 FROM ( SELECT * FROM watervalue ORDER BY id DESC LIMIT 20) Var1 ORDER BY id ASC');
$x_tanggal2  = mysqli_query($db, 'SELECT Time2 FROM ( SELECT * FROM watervalue ORDER BY id DESC LIMIT 20) Var1 ORDER BY id ASC');
$x_tanggal3  = mysqli_query($db, 'SELECT Time2 FROM ( SELECT * FROM watervalue ORDER BY id DESC LIMIT 20) Var1 ORDER BY id ASC');
$x_tanggal4  = mysqli_query($db, 'SELECT Time2 FROM ( SELECT * FROM watervalue ORDER BY id DESC LIMIT 20) Var1 ORDER BY id ASC');
$y_tds   = mysqli_query($db, 'SELECT tds FROM ( SELECT * FROM watervalue ORDER BY id DESC LIMIT 20) Var1 ORDER BY ID ASC');
$y_temp   = mysqli_query($db, 'SELECT waterTemp FROM ( SELECT * FROM watervalue ORDER BY id DESC LIMIT 20) Var1 ORDER BY ID ASC');
$y_ec   = mysqli_query($db, 'SELECT EC FROM ( SELECT * FROM watervalue ORDER BY id DESC LIMIT 20) Var1 ORDER BY ID ASC'); 
$y_ph   = mysqli_query($db, 'SELECT pH FROM ( SELECT * FROM watervalue ORDER BY id DESC LIMIT 20) Var1 ORDER BY ID ASC');   

// find total input from database
$result =	mysqli_query($db, "SELECT count(*) as total from watervalue");
$data	=	mysqli_fetch_assoc($result);

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

// find number of active and deactive sensors
$active 	= $tds_state + $temp_state + $ec_state + $ph_state;
$deactive = 4 - $active;
?>

<?php
// get tds max n min value for the day
$curr_date = date("Y-m-d");
$query = mysqli_query($db, "SELECT MAX(tds) as max_tds FROM watervalue WHERE date = .$curr_date.");
$max_tds = mysqli_fetch_array($query);
$max_tds = $max_tds[0];

$query = mysqli_query($db, "SELECT MIN(tds) as min_tds FROM watervalue WHERE date = .$curr_date.");
$min_tds = mysqli_fetch_array($query);
$min_tds = $min_tds[0];

// get temp max n min value for the day
$curr_date = date("Y-m-d");
$query = mysqli_query($db, "SELECT MAX(waterTemp) as max_temp FROM watervalue WHERE date = .$curr_date.");
$max_temp = mysqli_fetch_array($query);
$max_temp = $max_temp[0];

$query = mysqli_query($db, "SELECT MIN(waterTemp) as min_temp FROM watervalue WHERE date = .$curr_date.");
$min_temp = mysqli_fetch_array($query);
$min_temp = $min_temp[0];

// get ec max n min value for the day
$curr_date = date("Y-m-d");
$query = mysqli_query($db, "SELECT MAX(EC) as max_ec FROM watervalue WHERE date = .$curr_date.");
$max_ec = mysqli_fetch_array($query);
$max_ec = $max_ec[0];

$query = mysqli_query($db, "SELECT MIN(EC) as min_ec FROM watervalue WHERE date = .$curr_date.");
$min_ec = mysqli_fetch_array($query);
$min_ec = $min_ec[0];

// get ph max n min value for the day
$curr_date = date("Y-m-d");
$query = mysqli_query($db, "SELECT MAX(pH) as max_ph FROM watervalue WHERE date = .$curr_date.");
$max_ph = mysqli_fetch_array($query);
$max_ph = $max_ph[0];

$query = mysqli_query($db, "SELECT MIN(pH) as min_ph FROM watervalue WHERE date = .$curr_date.");
$min_ph = mysqli_fetch_array($query);
$min_ph = $min_ph[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
	<div class="content-wrapper">
	
		<div class="content-header">
			<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Dashboard</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Welcome <?php echo htmlspecialchars($_SESSION["username"]); ?></li>
					</ol>
				</div>
				</div>
			</div>
		</div> <!--end of content header-->

<section class="content">
<div class="container-fluid">
	  

<div class="row">
	<div class="col-lg-3 col-6">
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

	<div class="col-lg-3 col-6">
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

	<div class="col-lg-3 col-6">
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

	<div class="col-lg-3 col-6">
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
	
	

	
	
</div> <!--end of top row-->

<div class="row" >
	   <table class="table table-bordered table-striped">
        <thead>
          <tr >
            <th class='text-center'>Sensor</th>
            <th class='text-center'>TDS (ppm)</th>
            <th class='text-center'>Temperature (°C)</th> 
			<th class='text-center'>Electric Conductivity (μS/cm)</th>   
			<th class='text-center'>pH</th>   			
          </tr>
        </thead>
        <tbody>
			<tr>
				<td class='text-center'>Highest Value for <?php echo $curr_date ?> (Today)</td>
				<td class='text-center'><?php echo $max_tds ?></td>
				<td class='text-center'><?php echo $max_temp ?></td>
				<td class='text-center'><?php echo $max_ec ?></td>
				<td class='text-center'><?php echo $max_ph ?></td>
			</tr>
			
			<tr>
				<td class='text-center'>Lowest Value for <?php echo $curr_date ?> (Today)</td>
				<td class='text-center'><?php echo $min_tds ?></td>
				<td class='text-center'><?php echo $min_temp ?></td>
				<td class='text-center'><?php echo $min_ec ?></td>
				<td class='text-center'><?php echo $min_ph ?></td>
			</tr>		
			
        </tbody>
      </table> 
</div>


		
<div class="row" >
<div class="bootstrap">

<!--first graph-->	
<div class="col-xs-12 col-sm-6"> 
  <div class="panel panel-primary">
	<div class="panel-heading">
      <h3 class="panel-title"><center>TDS Graph (ppm)</h3>
    </div>

    <div class="panel-body">
      <canvas id="tds"></canvas>
      <script>
       var canvas = document.getElementById('tds');
        var data = {
            labels: [<?php while ($b = mysqli_fetch_array($x_tanggal1)) { echo '"' . $b['Time2'] . '",';}?>],
            datasets: [
            {
                label: "TDS",
                fill: true,
                lineTension: 0.1,
                backgroundColor: "rgba(105, 0, 132, .2)",
                borderColor: "rgba(200, 99, 132, .7)",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: "rgba(200, 99, 132, .7)",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(200, 99, 132, .7)",
                pointHoverBorderColor: "rgba(200, 99, 132, .7)",
                pointHoverBorderWidth: 2,
                pointRadius: 5,
                pointHitRadius: 10,
                data: [<?php while ($b = mysqli_fetch_array($y_tds)) { echo  $b['tds'] . ',';}?>],
            }
            ]
        };
		
        var option = 
        {
          showLines: true,
          animation: {duration: 0}
        };
        var myLineChart = Chart.Line(canvas,{
          data:data,
          options:option
        });
      </script>
    </div>    
  </div>
</div>

<!--second graph-->	
<div class="col-xs-12 col-sm-6">
	<div class="panel panel-primary">
		<div class="panel-heading">
		  <h3 class="panel-title"><center>Temperature Graph (°C)</h3>
		</div>
		
		<div class="panel-body">
		  <canvas id="temp"></canvas>
		  <script>
		   var canvas = document.getElementById('temp');
			var data = {
				labels: [<?php while ($b = mysqli_fetch_array($x_tanggal2)) { echo '"' . $b['Time2'] . '",';}?>],
				datasets: [
				{
					label: "Temperature", 
					fill: true,
					lineTension: 0.1,
					backgroundColor: "rgba(0, 137, 132, .2)",
					borderColor: "rgba(0, 10, 130, .7)",
					borderCapStyle: 'butt',
					borderDash: [],
					borderDashOffset: 0.0,
					borderJoinStyle: 'miter',
					pointBorderColor: "rgba(0, 10, 130, .7)",
					pointBackgroundColor: "#fff",
					pointBorderWidth: 1,
					pointHoverRadius: 5,
					pointHoverBackgroundColor: "rgba(0, 10, 130, .7)",
					pointHoverBorderColor: "rgba(0, 10, 130, .7)",
					pointHoverBorderWidth: 2,
					pointRadius: 5,
					pointHitRadius: 10,
					data: [<?php while ($b = mysqli_fetch_array($y_temp)) { echo  $b['waterTemp'] . ',';}?>],
				}
				]
			};

			var option = 
			{
			  showLines: true,
			  animation: {duration: 0}
			};
			var myLineChart = Chart.Line(canvas,{
			  data:data,
			  options:option
			});
		  </script>
		</div>    
	</div>
</div>

<!--third graph-->	
<div class="col-xs-12 col-sm-6">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title"><center>Electric Conductivity graph (μS/cm)</h3>
		</div>

		<div class="panel-body">
			<canvas id="ec"></canvas>
			<script>
			var canvas = document.getElementById('ec');
			var data = {
			labels: [<?php while ($b = mysqli_fetch_array($x_tanggal3)) { echo '"' . $b['Time2'] . '",';}?>],
			datasets: [
			{
				label: "EC",
				fill: true,
				lineTension: 0.1,
				backgroundColor: "rgba(105, 0, 132, .2)",
				borderColor: "rgba(200, 99, 132, .7)",
				borderCapStyle: 'butt',
				borderDash: [],
				borderDashOffset: 0.0,
				borderJoinStyle: 'miter',
				pointBorderColor: "rgba(200, 99, 132, .7)",
				pointBackgroundColor: "#fff",
				pointBorderWidth: 1,
				pointHoverRadius: 5,
				pointHoverBackgroundColor: "rgba(200, 99, 132, .7)",
				pointHoverBorderColor: "rgba(200, 99, 132, .7)",
				pointHoverBorderWidth: 2,
				pointRadius: 5,
				pointHitRadius: 10,
				data: [<?php while ($b = mysqli_fetch_array($y_ec)) { echo  $b['EC'] . ',';}?>],
			}
			]
			};

			var option = 
			{
			showLines: true,
			animation: {duration: 0}
			};
			var myLineChart = Chart.Line(canvas,{
			data:data,
			options:option
			});
			</script>
		</div>    
	</div>
</div>

<!--fourth graph-->
<div class="col-xs-12 col-sm-6">
	<div class="panel panel-primary">
		<div class="panel-heading">
		  <h3 class="panel-title"><center>pH Graph</h3>
		</div>

		<div class="panel-body">
		  <canvas id="pH"></canvas>
		  <script>
		   var canvas = document.getElementById('pH');
			var data = {
				labels: [<?php while ($b = mysqli_fetch_array($x_tanggal4)) { echo '"' . $b['Time2'] . '",';}?>],
				datasets: [
				{
					label: "pH", 
					fill: true,
					lineTension: 0.1,
					backgroundColor: "rgba(0, 137, 132, .2)",
					borderColor: "rgba(0, 10, 130, .7)",
					borderCapStyle: 'butt',
					borderDash: [],
					borderDashOffset: 0.0,
					borderJoinStyle: 'miter',
					pointBorderColor: "rgba(0, 10, 130, .7)",
					pointBackgroundColor: "#fff",
					pointBorderWidth: 1,
					pointHoverRadius: 5,
					pointHoverBackgroundColor: "rgba(0, 10, 130, .7)",
					pointHoverBorderColor: "rgba(0, 10, 130, .7)",
					pointHoverBorderWidth: 2,
					pointRadius: 5,
					pointHitRadius: 10,
					data: [<?php while ($b = mysqli_fetch_array($y_ph)) { echo  $b['pH'] . ',';}?>],
				}
				]
			};
			var option = 
			{
			  showLines: true,
			  animation: {duration: 0}
			};	
			var myLineChart = Chart.Line(canvas,{
			  data:data,
			  options:option
			});
		  </script>
		</div>    
	</div>
</div>

</div> <!-- end of bootstrap class -->
</div> <!-- end of row -->
  
</div>  
</div>
</section>
</body>


