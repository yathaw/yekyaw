<?php 
  
  require('connection.php');
  session_start();
  $id = $_POST['id'];
  $course = $_POST['course'];
  $title = $_POST['title'];
  $semester = $_POST['semester'];
  $batches = $_POST['batches'];
  $userid = $_SESSION['login_user']['id'];

  $sql = "SELECT * FROM batch_coursework WHERE coursework_id=:value1";
  $statement = $conn->prepare($sql);
  $statement->bindParam(':value1', $id);
  $statement->execute();

  $batch_coursework = $statement->fetchAll();


  $bids = [];
  foreach($batch_coursework as $bc){
    $bids[] = $bc['batch_id'];
  }

  foreach($batches as $batch){
    if(!in_array($batch, $bids)){
      $sql = "INSERT INTO batch_coursework (batch_id, coursework_id) VALUES(:value1, :value2)";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':value1', $batch);
      $stmt->bindParam(':value2', $id);
      $stmt->execute();
    }
    
  }

  foreach ($bids as $bid)
  {
    if(!in_array($bid, $batches)){
      $sql = "DELETE FROM batch_coursework WHERE batch_id=:value1 AND coursework_id=:value2";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':value1', $bid);
        $stmt->bindParam(':value2', $id);
        $stmt->execute();
    }
  }


  $sql = "UPDATE coursework SET title=:value1, semester=:value2, course_id=:value3, created_by=:value4 WHERE id=:value5";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':value1', $title);
  $stmt->bindParam(':value2', $semester);
  $stmt->bindParam(':value3', $course);
  $stmt->bindParam(':value4', $userid);
  $stmt->bindParam(':value5', $id);
  $stmt->execute();


  $_SESSION['success_msg']="One Coursework is <b> CREATED </b> successfully in our database.";

  header('location:coursework_list.php');

?>