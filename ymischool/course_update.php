<?php 
  
  require('connection.php');
  session_start();

  $id = $_POST['id'];
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
  $oldphoto = $_POST['oldphoto'];
  $oldvideo = $_POST['oldvideo'];

  $photo = $_FILES['photo'];

  if($photo['name']){
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
  }else{
    $dest_path = $oldphoto;
  }  
  $video = $_FILES['video'];
  if($video['name']){

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
  }else{
    $video_dest_path = $oldvideo;
  }
  $sql = "UPDATE courses SET codeno=:value1, title=:value2, description=:value3, image=:value4, video=:value5 , price=:value6, duration=:value7, subcategory_id=:value8, studylevel=:value9, totalclass=:value10, totalcoursework=:value11, totalstudent=:value12, created_by=:value13 WHERE id=:value14";
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
  $stmt->bindParam(':value14', $id);
  $stmt->execute();


  $courseid = $id;

  $_SESSION['success_msg']="One Course is <b> Updated </b> successfully in our database.";
  header("Location: course_detail.php?id=$courseid");

  // header('location:course_list.php');

?>