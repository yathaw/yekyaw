<?php 
	
	require('connection.php');
  	session_start();

	$id = $_POST['id'];

	$sql = "DELETE FROM materials WHERE id=:value1";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':value1', $id);
	$stmt->execute();

  	$_SESSION['success_msg']="One Material is <b> DELETED </b> successfully in our database.";


	header("location:subject_list.php");

?>