<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} 
include('connection.php');	
?>


<?php
if(isset($_POST["email"]) && (!empty($_POST["email"]))){
	$email = $_POST["email"];
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	$email = filter_var($email, FILTER_VALIDATE_EMAIL);

	$error = "";
	
	if (!$email) {
		$error = "<p>Invalid email address please type a valid email address!</p>";
	}
	else{
		$sel_query = "SELECT * FROM `users` WHERE email='".$email."'";
		$results = mysqli_query($db,$sel_query);
		$row = mysqli_num_rows($results);
		if ($row==""){
			$error = "<p>No user is registered with this email address!</p>";
		}
	}
	
	if($error != ""){
		echo "<div class='error'>".$error."</div>
		<br /><a href='javascript:history.go(-1)'>Go Back</a>";
	}
	else{
		$query = mysqli_query($db, "SELECT password FROM users WHERE email='".$email."' ");
		$password = mysqli_fetch_row($query); // in array format 
		
		$expFormat = mktime(date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y"));
		$expDate = date("Y-m-d H:i:s",$expFormat);
		$key = md5("2418*2".$email);
		$addKey = substr(md5(uniqid(rand(),1)),3,10);
		$key = $key . $addKey;
		
		$_SESSION["email"] = $email;
		$_SESSION["password"] = $password[0];

		include('../PHPMailer/mail-forgot-password.php');	
		echo "An email has been sent to you with instructions on how to reset your password. ";
		echo '<a href="login.php">Click here to log in</a>';
	}
}
else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Forgot Password</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">

<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>H2O</b>Bot</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You forgot your password? Send us your email and we will assist you from there!</p>



      <form action="" method="post" name="reset">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Request new password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="login.php">Login</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new account</a>
      </p>
</div>
</div>
</div>
<?php } ?>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>