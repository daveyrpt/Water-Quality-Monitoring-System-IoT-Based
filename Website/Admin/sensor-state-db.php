<?php
if(isset($_POST["name"]))
{
 $connect = new PDO("mysql:host=localhost;dbname=h2obot", "root", "");
 $query = "
 INSERT INTO sensor_state ( tds_state,temp_state,ec_state,ph_state) 
 VALUES( :gender ,:gender1, :gender2 ,:gender3)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   //':name'   => $_POST['name'],
   ':gender'  => $_POST['hidden_gender'],
   ':gender1'  => $_POST['hidden_gender1'],
   ':gender2'  => $_POST['hidden_gender2'],
   ':gender3'  => $_POST['hidden_gender3']
  )
 );

 $result = $statement->fetchAll();
 if(isset($result))
 {
  echo 'done';
 }
}

?>