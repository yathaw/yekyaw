<?php 
  
  require('connection.php');
  session_start();

  $name = $_POST['name'];
  

  $sql = "INSERT INTO position (name) VALUES(:value1)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':value1', $name);
  $stmt->execute();

  $_SESSION['success_msg']="One position is <b> CREATED </b> successfully in our database.";

  header('location:position_list.php');

?>