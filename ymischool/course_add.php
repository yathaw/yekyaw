<?php 
  
  require('connection.php');
  session_start();

  $codeno = $_POST['codeno'];
  $title = $_POST['title'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $duration = $_POST['duration'];
  $subcategory = $_POST['subcategory'];
  $studylevel = $_POST['studylevel'];

  $totalclass = $_POST['totalclass'];
  $totalcoursework = $_POST['totalcoursework'];
  $totalstudent = $_POST['totalstudent'];
  $userid = 1; 

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

  $video = $_FILES['video'];
  $video_uploadFileDir = "upload/video/";

    $video_fileTmpPath = $_FILES['video']['tmp_name'];
    $video_fileName = $_FILES['video']['name'];
    $video_fileSize = $_FILES['video']['size'];
    $video_fileType = $_FILES['video']['type'];
    $video_fileNameCmps = explode(".", $video_fileName);
    $video_fileExtension = strtolower(end($video_fileNameCmps));
    $video_newFileName = md5(time() . $video_fileName) . '.' . $video_fileExtension;
    $video_dest_path = $video_uploadFileDir . $video_newFileName; 

  move_uploaded_file($video_fileTmpPath, $video_dest_path);
  

  $sql = "INSERT INTO courses (codeno, title, description, image, video, price, duration, subcategory_id, studylevel, totalclass, totalcoursework, totalstudent, created_by) VALUES(:value1, :value2, :value3, :value4, :value5, :value6, :value7, :value8, :value9, :value10, :value11, :value12, :value13)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':value1', $codeno);
  $stmt->bindParam(':value2', $title);
  $stmt->bindParam(':value3', $description);
  $stmt->bindParam(':value4', $dest_path);
  $stmt->bindParam(':value5', $video_dest_path);
  $stmt->bindParam(':value6', $price);
  $stmt->bindParam(':value7', $duration);
  $stmt->bindParam(':value8', $subcategory);
  $stmt->bindParam(':value9', $studylevel);
  $stmt->bindParam(':value10', $totalclass);
  $stmt->bindParam(':value11', $totalcoursework);
  $stmt->bindParam(':value12', $totalstudent);
  $stmt->bindParam(':value13', $userid);
  $stmt->execute();


  $courseid = $conn->lastInsertId();

  $_SESSION['success_msg']="One Course is <b> CREATED </b> successfully in our database.";
  header("Location: course_detail.php?id=$courseid");

  // header('location:course_list.php');

?>