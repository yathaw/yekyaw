<?php 
  
  require('connection.php');
  session_start();

  $courseid = $_POST['courseid'];
  $title = $_POST['title'];
  $file = $_FILES['file'];
  $userid = 1;
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

  $sql = "INSERT INTO materials (title, file, type, size, course_id, created_by) VALUES(:value1, :value2, :value3, :value4, :value5, :value6)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':value1', $title);
  $stmt->bindParam(':value2', $dest_path);
  $stmt->bindParam(':value3', $fileType);
  $stmt->bindParam(':value4', $fileSize);
  $stmt->bindParam(':value5', $courseid);
  $stmt->bindParam(':value6', $userid);
  $stmt->execute();

  $_SESSION['success_msg']="One Material is <b> CREATED </b> successfully in our database.";

  header("Location: course_detail.php?id=$courseid");
  // header('location:course_list.php');

?>