<?php
if(isset($_POST["name"]))
{
 $connect = new PDO("mysql:host=localhost;dbname=h2obot", "root", "");
 $query = "
 INSERT INTO scheduler_state (state) 
 VALUES(:gender)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   //':name'   => $_POST['name'],
   ':gender'  => $_POST['hidden_gender']
  )
 );

	$curmark1 = date("Y-m-d H:i:s");
	$query = mysqli_query($db,"INSERT INTO `last_mark` (`exp_mark`) VALUES ('".$curmark1."');");
 $result = $statement->fetchAll();
 if(isset($result))
 {
  echo 'done';
 }
}


?>