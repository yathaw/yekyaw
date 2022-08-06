<?php 
  
  require('connection.php');
  session_start();

  $name = $_POST['name'];
  $category = $_POST['category'];

  

  $sql = "INSERT INTO subcategories (name, category_id) VALUES(:value1, :value2)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':value1', $name);
  $stmt->bindParam(':value2', $category);
  $stmt->execute();

  $_SESSION['success_msg']="One Subject is <b> CREATED </b> successfully in our database.";

  header('location:subject_list.php');

?>