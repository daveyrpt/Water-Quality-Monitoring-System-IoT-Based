<?php
// Initialize the session

 
// Unset all of the session variables
$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
 
// Destroy the session.
    if(isset($_POST['clear'])) {

      session_start();
      unset($_SESSION);
	  session_destroy();

    }

 
// Redirect to login page
header("location: ../index.html");
exit;
?>