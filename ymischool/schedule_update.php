<?php 
  
  require('connection.php');
  session_start();

  $id = $_POST['id'];
  $title = $_POST['title'];
  $day = $_POST['day'];
  $starttime = $_POST['starttime'];
  $endtime = $_POST['endtime'];

  $time = $starttime.'-'.$endtime;

  $color = $_POST['color'];
  $staff = $_POST['staff'];
  $userid = 1;

  $sql = "UPDATE schedules SET title=:value1, day=:value2, time_event=:value3, color=:value4, staff_id=:value5, created_by=:value6 WHERE id=:value7";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':value1', $title);
  $stmt->bindParam(':value2', $day);
  $stmt->bindParam(':value3', $time);
  $stmt->bindParam(':value4', $color);
  $stmt->bindParam(':value5', $staff);
  $stmt->bindParam(':value6', $userid);
  $stmt->bindParam(':value7', $id);
  $stmt->execute();

  $_SESSION['success_msg']="One Schedule is <b> UPDATED </b> successfully in our database.";

  header('location:schedule_list.php');

?>