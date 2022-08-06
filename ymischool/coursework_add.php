<?php 
  
  require('connection.php');
  session_start();

  $course = $_POST['course'];
  $title = $_POST['title'];
  $semester = $_POST['semester'];
  $batches = $_POST['batches'];
  $userid = $_SESSION['login_user']['id'];

  $sql = "INSERT INTO coursework (title, semester, course_id, created_by) VALUES(:value1, :value2, :value3, :value4)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':value1', $title);
  $stmt->bindParam(':value2', $semester);
  $stmt->bindParam(':value3', $course);
  $stmt->bindParam(':value4', $userid);
  $stmt->execute();

  foreach($batches as $batch){
    $sql = "INSERT INTO batch_coursework (batch_id, coursework_id) VALUES(:value1, :value2)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':value1', $batch);
    $stmt->bindParam(':value2', $course);
    $stmt->execute();
  }

  $_SESSION['success_msg']="One Coursework is <b> CREATED </b> successfully in our database.";

  header('location:coursework_list.php');

?>