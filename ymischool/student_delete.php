<?php 
	
	require('connection.php');
  	session_start();

	$id = $_POST['id'];
	$batchid = $_POST['batchid'];
	$status = 0;	

	$sql = "SELECT * FROM enroll 
			WHERE student_id =:value1 AND batch_id=:value2";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':value1', $id);
    $statement->bindParam(':value2', $batchid);
    $statement->execute();
    $enroll = $statement->fetch(PDO::FETCH_ASSOC);

    $enrollid = $enroll['id'];

    $sql = "UPDATE enroll SET status=:value1 WHERE id=:value2";
    $stmt = $conn->prepare($sql);
	$stmt->bindParam(':value1', $status);
	$stmt->bindParam(':value2', $enrollid);
	$stmt->execute();

  	$_SESSION['success_msg']="One Student is <b> Removed </b> successfully in our database.";


	header("location:student_list.php");

?>