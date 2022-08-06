<?php 
  
  require('connection.php');
  session_start();

  $name = $_POST['name'];
  

  $sql = "INSERT INTO categories (name) VALUES(:value1)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':value1', $name);
  $stmt->execute();

  $_SESSION['success_msg']="One Category is <b> CREATED </b> successfully in our database.";

  header('location:category_list.php');

?>