<?php 
  
  require('connection.php');
  session_start();

  $id = $_POST['id'];
  $name = $_POST['name'];
  $enddate = $_POST['enddate'];
  $description = $_POST['description'];
  $userid = 1;
  $oldfile = $_POST['oldfile'];
  $courseworkid = $_POST['courseworkid'];

    
  $file = $_FILES['file'];
  if ($file['name']) 
  {
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
  }else{
    $dest_path = $oldfile;
  }
  $sql = "UPDATE assignment SET name=:value1, file=:value2, description=:value3, enddate=:value4, coursework_id=:value5, created_by=:value6  WHERE id=:value7";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':value1', $name);
  $stmt->bindParam(':value2', $dest_path);
  $stmt->bindParam(':value3', $description);
  $stmt->bindParam(':value4', $enddate);
  $stmt->bindParam(':value5', $courseworkid);
  $stmt->bindParam(':value6', $userid);
  $stmt->bindParam(':value7', $id);

  $stmt->execute();


  $_SESSION['success_msg']="One Assignment is <b> UPDATED </b> successfully in our database.";

  header("Location: assignment_list.php?id=$courseworkid");
  

?>