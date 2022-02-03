<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} 
include('connection.php');	
?>

<?php
$query = mysqli_query($db, "SELECT email FROM users WHERE username='".$_SESSION["username"]."' "); 
$email = mysqli_fetch_row($query);
$_SESSION["email"] = $email[0];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- aliean -->
</head>

<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">

	  <!-- Preloader -->
	  <div class="preloader flex-column justify-content-center align-items-center">
		<img class="animation__wobble" src="dist/img/H2O.png" alt="H2OBot" height="60" width="60">
	  </div>

	  <!-- Top Navbar -->
	  <nav class="main-header navbar navbar-expand navbar-light">
		<!-- Left navbar links -->
		<ul class="navbar-nav">
		  <li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		  </li>
		  <li class="nav-item d-none d-sm-inline-block">
			<a href="home.php" class="nav-link">Home</a>
		  </li>

		</ul>

		<!-- Right navbar links -->
		<ul class="navbar-nav ml-auto"		
		  <li class="nav-item">
			<a class="nav-link" data-widget="fullscreen" href="#" role="button">
			  <i class="fas fa-expand-arrows-alt"></i>
			</a>
		  </li>
		</ul>
	  </nav>
	  <!-- /.navbar -->

	  <!-- Main Sidebar Container -->
	  <aside class="main-sidebar sidebar-dark-primary elevation-4">
		<!-- Brand Logo -->
		<a href="index3.html" class="brand-link">
		  <img src="dist/img/H2O.png" alt="AdminLTE Logo" class="brand-image img-square elevation-3" style="opacity: .8">
		  <span class="brand-text font-weight-light">H2O Bot</span>
		</a>

		<!-- Sidebar -->
		<div class="sidebar">
		  <!-- Sidebar user panel (optional) -->
		  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
			  <img src="dist/img/guest.png" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
			  <a href="#" class="d-block"><?php echo $_SESSION["username"] ?></a>
			</div>
		  </div>

		  <!-- Sidebar Menu -->
		  <nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			  <!-- Add icons to the links using the .nav-icon class
				   with font-awesome or any other icon font library -->
			  <li class="nav-item">
				<a href="home.php" class="nav-link ">
				  <i class="nav-icon fas fa-tachometer-alt"></i>
				  <p>
					Dashboard
				  </p>
				</a>
			  </li>
			  
			  <li class="nav-item">
				<a href="data-grouping.php" class="nav-link">
				  <i class="nav-icon fas fa-table"></i>
				  <p>
					Data
				  </p>
				</a>
			  </li>
			  
			  <li class="nav-item">
				<a href="log.php" class="nav-link">
				  <i class="nav-icon fas fa-edit"></i>
				  <p>
					Log
					
				  </p>
				</a>
			  </li>
			  
			  <li class="nav-item">
				<a href="#" class="nav-link">
				  <i class="nav-icon fas fa-th"></i>
				  <p>
					Extras
					<i class="fas fa-angle-left right"></i>
					<span class="badge badge-info right">3</span>
				  </p>
				</a>
				<ul class="nav nav-treeview">
				  <li class="nav-item">
					<a href="warning-noti.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Warning Notification</p>
					  <span class="right badge badge-danger">New</span>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="sensor-state.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Sensor State</p>
					  <span class="right badge badge-danger">New</span>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="scheduler.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Scheduler</p>
					  <span class="right badge badge-danger">New</span>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="reset-password.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Reset Password</p>
					</a>
				  </li>
				</ul>
			  </li>
			  
				<li class="nav-item">
					<a href="logout.php" class="nav-link">
						<i class="nav-icon far fa-circle text-danger"></i>
						<p class="text">Logout</p>
					</a>
				 </li>
			</ul>
		  </nav>
		  <!-- /.sidebar-menu -->
		</div>
		<!-- /.sidebar -->
	  </aside>

	  <!-- Content Wrapper. Contains page content -->

	  <!-- /.content-wrapper -->

	  <!-- Control Sidebar -->
	  <aside class="control-sidebar control-sidebar-dark">
		<!-- Control sidebar content goes here -->
	  </aside>
	  <!-- /.control-sidebar -->

	  <!-- Main Footer -->

	</div>

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>

<!-- old ver layout js -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>


</body>
</html>