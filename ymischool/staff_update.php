<?php 
  
  require('connection.php');
  session_start();
  
  $id = $_POST['id'];
  $name = $_POST['name'];
  $dob = $_POST['dob'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $oldphoto = $_POST['oldphoto'];


  $photo = $_FILES['newphoto'];

  if ($photo['name']) 
  {
    $uploadFileDir = "upload/img/";

      $fileTmpPath = $_FILES['newphoto']['tmp_name'];
      $fileName = $_FILES['newphoto']['name'];
      $fileSize = $_FILES['newphoto']['size'];
      $fileType = $_FILES['newphoto']['type'];
      $fileNameCmps = explode(".", $fileName);
      $fileExtension = strtolower(end($fileNameCmps));


      $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
      $dest_path = $uploadFileDir . $newFileName; 

    move_uploaded_file($fileTmpPath, $dest_path);
  }else{
    $dest_path = $oldphoto;
  }

  $sql = "UPDATE staff SET name=:value1, profile=:value2, dob=:value3, address=:value4, email=:value5 WHERE id=:value6";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':value1', $name);
  $stmt->bindParam(':value2', $dest_path);
  $stmt->bindParam(':value3', $dob);
  $stmt->bindParam(':value4', $address);
  $stmt->bindParam(':value5', $email);
  $stmt->bindParam(':value6', $id);
  $stmt->execute();

  $_SESSION['success_msg']="One Staff is <b> UPDATED </b> successfully in our database.";

  header('location:staff_list.php');

?>