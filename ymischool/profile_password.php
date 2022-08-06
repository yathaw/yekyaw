<?php 
  
  require('connection.php');
  session_start();
  $login_user_type =$_SESSION['login_user_type'];
  
  $id = $_POST['id'];
  $password = $_POST['password'];

  if($login_user_type == "Staff"){
    $sql = "UPDATE staff SET password=:value1 WHERE id=:value2";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':value1', $password);
    $stmt->bindParam(':value2', $id);
    $stmt->execute();
  }
  else{
    $sql = "UPDATE students SET password=:value1 WHERE id=:value2";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':value1', $password);
    $stmt->bindParam(':value2', $id);
    $stmt->execute();
  }

  $_SESSION['success_msg']="Your Password is <b> UPDATED </b> successfully in our database.";

  header('location:profile.php');

?>