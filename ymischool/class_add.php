<?php 
  
  require('connection.php');
  session_start();

  $course = $_POST['course'];
  $name = $_POST['name'];
  $startdate = $_POST['startdate'];
  $enddate = $_POST['enddate'];
  $starttime = $_POST['starttime'];
  $endtime = $_POST['endtime'];
  $teachers = $_POST['teachers']; 
  $type = $_POST['type']; 
  $teamlink = $_POST['teamlink'];
   
  $userid = 1;

  $sql = "INSERT INTO batches (name, startdate, enddate, starttime, endtime, course_id, created_by, type, teamlink) VALUES(:value1, :value2, :value3, :value4, :value5, :value6, :value7,:value8, :value9)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':value1', $name);
  $stmt->bindParam(':value2', $startdate);
  $stmt->bindParam(':value3', $enddate);
  $stmt->bindParam(':value4', $starttime);
  $stmt->bindParam(':value5', $endtime);
  $stmt->bindParam(':value6', $course);
  $stmt->bindParam(':value7', $userid);
  $stmt->bindParam(':value8', $type);
  $stmt->bindParam(':value9', $teamlink);
  $stmt->execute();

  $batchid = $conn->lastInsertId();
  foreach($teachers as $teacher){
    $sql = "INSERT INTO batch_staff (batch_id, staff_id) VALUES(:value1, :value2)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':value1', $batchid);
    $stmt->bindParam(':value2', $teacher);
    $stmt->execute();
  }

  $_SESSION['success_msg']="One Class is <b> CREATED </b> successfully in our database.";

  header('location:class_list.php');

?>