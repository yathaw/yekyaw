<?php 
	
	require('connection.php');
  	session_start();

	$id = $_GET['id'];

	$sql = "DELETE FROM courses WHERE id=:value1";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':value1', $id);
	$stmt->execute();

  	$_SESSION['success_msg']="One Course is <b> DELETED </b> successfully in our database.";


	header("location:course_list.php");

?>