<?php 
  
  require('connection.php');
  session_start();

  $courseworkid = $_POST['courseworkid'];
  $name = $_POST['name'];
  $enddate = $_POST['enddate'];
  $description = $_POST['description'];
  $userid = $_SESSION['login_user']['id'];
  
  $file = $_FILES['file'];
  $uploadFileDir = "upload/file/";

    $fileTmpPath = $_FILES['file']['tmp_name'];
    $fileName = $_FILES['file']['name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = $_FILES['file']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    $FileName = md5(time() . $fileName) . '.' . $fileExtension;
    $dest_path = $uploadFileDir . $FileName; 

  move_uploaded_file($fileTmpPath, $dest_path);  
   

  $sql = "INSERT INTO assignment (name, file, description, enddate, coursework_id, created_by) VALUES(:value1, :value2, :value3, :value4, :value5, :value6)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':value1', $name);
  $stmt->bindParam(':value2', $dest_path);
  $stmt->bindParam(':value3', $description);
  $stmt->bindParam(':value4', $enddate);
  $stmt->bindParam(':value5', $courseworkid);
  $stmt->bindParam(':value6', $userid);

  $stmt->execute();


  $_SESSION['success_msg']="One Assignment is <b> CREATED </b> successfully in our database.";

  header("Location: assignment_list.php?id=$courseworkid");
  

?>