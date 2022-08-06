<?php 
  
  require('connection.php');
  session_start();

  $batch = $_POST['batch'];
  $title = $_POST['title'];
  $day = $_POST['day'];
  $starttime = $_POST['starttime'];
  $endtime = $_POST['endtime'];

  $time = $starttime.'-'.$endtime;

  $color = $_POST['color'];
  $staff = $_POST['staff'];
  $userid = 1;

  $sql = "INSERT INTO schedules (title, day, time_event, color, staff_id, batch_id, created_by) VALUES(:value1, :value2, :value3, :value4, :value5, :value6, :value7)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':value1', $title);
  $stmt->bindParam(':value2', $day);
  $stmt->bindParam(':value3', $time);
  $stmt->bindParam(':value4', $color);
  $stmt->bindParam(':value5', $staff);
  $stmt->bindParam(':value6', $batch);
  $stmt->bindParam(':value7', $userid);

  $stmt->execute();

  $_SESSION['success_msg']="One Schedule is <b> CREATED </b> successfully in our database.";

  header('location:schedule_list.php');

?>