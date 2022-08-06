<?php 
  
  require('connection.php');
  session_start();

  $id = $_POST['id'];
  $title = $_POST['title'];
  $file = $_FILES['file'];
  $userid = 1;
  $oldfile = $_POST['oldfile'];
  $oldfiletype = $_POST['oldfiletype'];
  $oldfilesize = $_POST['oldfilesize'];
  $courseid = $_POST['courseid'];
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
    $fileType = $oldfiletype;
    $fileSize = $oldfilesize; 
  }

  $sql = "UPDATE materials SET title=:value1, file=:value2, type=:value3, size=:value4, created_by=:value5 WHERE id=:value6";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':value1', $title);
  $stmt->bindParam(':value2', $dest_path);
  $stmt->bindParam(':value3', $fileType);
  $stmt->bindParam(':value4', $fileSize);
  $stmt->bindParam(':value5', $userid);
  $stmt->bindParam(':value6', $id);
  $stmt->execute();

  $_SESSION['success_msg']="One Material is <b> UPDATED </b> successfully in our database.";

  header("Location: course_detail.php?id=$courseid");
  // header('location:course_list.php');

?>