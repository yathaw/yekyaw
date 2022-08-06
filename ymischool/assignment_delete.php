<?php 
	
	require('connection.php');
  	session_start();

	$id = $_POST['id'];
	$courseworkid = $_POST['courseworkid'];


	$sql = "DELETE FROM assignment WHERE id=:value1";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':value1', $id);
	$stmt->execute();

  	$_SESSION['success_msg']="One Assignment is <b> DELETED </b> successfully in our database.";


  	header("Location: assignment_list.php?id=$courseworkid");


?>