<?php 
  
  require('connection.php');
  session_start();

  $name = $_POST['name'];
  $dob = $_POST['dob'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $address = $_POST['address'];

  $position = $_POST['position'];

  $photo = $_FILES['photo'];

  $uploadFileDir = "upload/img/";

    $fileTmpPath = $_FILES['photo']['tmp_name'];
    $fileName = $_FILES['photo']['name'];
    $fileSize = $_FILES['photo']['size'];
    $fileType = $_FILES['photo']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));


    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
    $dest_path = $uploadFileDir . $newFileName; 

  move_uploaded_file($fileTmpPath, $dest_path);
  

  $sql = "INSERT INTO staff(name, profile, dob, address, email, password) VALUES(:value1, :value2, :value3, :value4, :value5, :value6)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':value1', $name);
  $stmt->bindParam(':value2', $dest_path);
  $stmt->bindParam(':value3', $dob);
  $stmt->bindParam(':value4', $address);
  $stmt->bindParam(':value5', $email);
  $stmt->bindParam(':value6', $password);
  $stmt->execute();

  $userid = $conn->lastInsertId();

  $sql = "INSERT INTO staff_position(staff_id, position_id) VALUES (?,?)";
  $conn->prepare($sql)->execute([$userid, $position]);

  $_SESSION['success_msg']="One Staff is <b> CREATED </b> successfully in our database.";

  header('location:staff_list.php');

?>