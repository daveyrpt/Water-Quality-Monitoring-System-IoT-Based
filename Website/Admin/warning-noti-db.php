<?php
if(isset($_POST["name"]))
{
 $connect = new PDO("mysql:host=localhost;dbname=h2obot", "root", "");
 $query = "INSERT INTO noti_state ( state) VALUES( :gender)";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   //':name'   => $_POST['name'],
   ':gender'  => $_POST['hidden_gender']
  )
 );

 $result = $statement->fetchAll();
 if(isset($result))
 {
  echo 'done';
 }
}

?>