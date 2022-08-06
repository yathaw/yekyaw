<?php 
  
  require('connection.php');
  session_start();

  $file = $_FILES['file'];
  $userid = $_SESSION['login_user']['id'];
  $courseworkid = $_POST['courseworkid'];
  $assignmentid = $_POST['assignmentid'];
  $date = date('Y-m-d');

  	$uploadFileDir = "upload/zip/";

    $fileTmpPath = $_FILES['file']['tmp_name'];
    $fileName = $_FILES['file']['name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = $_FILES['file']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    $FileName = md5(time() . $fileName) . '.' . $fileExtension;
    $dest_path = $uploadFileDir . $FileName; 

  	move_uploaded_file($fileTmpPath, $dest_path);

  	$sql = "SELECT * FROM assignment_submission 
		WHERE student_id =:value1 AND assignment_id=:value2";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':value1', $userid);
    $statement->bindParam(':value2', $assignmentid);
    $statement->execute();
    $assignment_submission = $statement->fetch(PDO::FETCH_ASSOC);

    $assignment_submission_id = $assignment_submission['id'];
    if($assignment_submission_id){
    	unlink($assignment_submission['file']);

    	$sql = "UPDATE assignment_submission SET uploaddate=:value1, file=:value2  WHERE id=:value3";
  		$stmt = $conn->prepare($sql);
  		$stmt->bindParam(':value1', $date);
	  	$stmt->bindParam(':value2', $dest_path);
	  	$stmt->bindParam(':value3', $assignment_submission_id);
	  	$stmt->execute();

    }else{
    	

	  	$sql = "INSERT INTO assignment_submission (uploaddate, file, student_id, assignment_id, coursework_id) VALUES(:value1, :value2, :value3, :value4, :value5)";
	  	$stmt = $conn->prepare($sql);
	  	$stmt->bindParam(':value1', $date);
	  	$stmt->bindParam(':value2', $dest_path);
	  	$stmt->bindParam(':value3', $userid);
	  	$stmt->bindParam(':value4', $assignmentid);
	  	$stmt->bindParam(':value5', $courseworkid);
	  	$stmt->execute();
    }
  	

  $_SESSION['success_msg']="Your File is <b> UPLOADED </b> successfully in our database.";

  header('location:coursework_list.php');

?>